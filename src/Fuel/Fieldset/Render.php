<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset;

use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Security\CSRFProvider;
use Fuel\Fieldset\Security\CSRFNullProvider;

/**
 * Defines a common interface for rendering fieldsets, forms and input attributes
 *
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Render
{

	protected static $methodPrefix = 'render';

	/**
	 * @var CSRFProvider CSRF implementation to use when rendering the form
	 */
	protected $csrfProvider;

	public function __construct(CSRFProvider $csrf = null)
	{
		if (is_null($csrf))
		{
			$csrf = new CSRFNullProvider;
		}

		$this->csrfProvider = $csrf;
	}

	/**
	 * This is the main render function that will work what function from the
	 * subclass to call to render the given object.
	 *
	 * Works out if there is a function that matches the element class name
	 * to be able to magically add extra rendering functions.
	 *
	 * @param \Fuel\Fieldset\Element $element
	 *
	 * @return string
	 * @throws \InvalidArgumentException
	 */
	public function render(Renderable $element)
	{
		// First get the name of the class
		$className = $this->getClassName($element);

		// Work out the function name to look for
		$functionName = static::$methodPrefix . $className;

		// Something to store the callable name in for later
		$callName = '';

		// TODO: find a cleaner way of doing this
		$is_container = $element instanceof Form;

		if ($is_container)
		{
			$this->csrfProvider->insertTokenPreRender($element);
		}

		// Check to see if our method is callable
		if (is_callable([$this, $functionName], false, $callName))
		{
			$result = call_user_func($callName, $element);
		}
		// If not callable then use the default function
		else
		{
			// Check for a generic fallback in the renderer

			$inputRenderFunction = static::$methodPrefix . 'Input';
			$inputRender = [$this, $inputRenderFunction];

			if (is_callable($inputRender, false, $callName))
			{
				$result = $this->$inputRenderFunction($element);
			}
			else
			{
				// Finally check if there is a render method in the object
				$elementRender = [$element, 'render'];

				if (is_callable($elementRender))
				{
					// If so call the render method
					$result = $element->render($this);
				}
				else
				{
					// No render method was found for this at all so throw a hissy fit
					throw new \InvalidArgumentException('Unable to find a render method for ' . get_class($element));
				}
			}
		}

		if ($is_container)
		{
			$this->csrfProvider->insertTokenPostRender($result);
		}

		return $result;
	}

	/**
	 * Gets the base class name.
	 *
	 * If a value of 'Fuel\Fieldset\Element' is passed then 'Element' is returned.
	 * If an object is passed rather than a string get_class() will be used to get the class name first.
	 *
	 * This really should be moved to common
	 *
	 * @param  mixed $object
	 *
	 * @return string
	 */
	protected function getClassName($object)
	{
		if (is_object($object))
		{
			$object = get_class($object);
		}

		$nameArray = explode('\\', $object);

		return array_pop($nameArray);
	}

}
