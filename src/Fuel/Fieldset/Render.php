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

/**
 * Defines a common interface for rendering fieldsets, forms and input attributes
 *
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Render
{

	protected static $_methodPrefix = 'render';
	
	/**
	 * This is the main render function that will work what function from the 
	 * subclass to call to render the given object.
	 * 
	 * Works out if there is a function that matches the element class name
	 * to be able to magically add extra rendering functions.
	 * 
	 * @param \Fuel\Fieldset\Element $element
	 * @return type
	 */
	public function render(Renderable $element)
	{
		//First get the name of the class
		$className = $this->getClassName($element);
		
		//Work out the function name to look for
		$functioName = static::$_methodPrefix . $className;
		
		//Something to store the callable name in for later
		$callName = '';
		
		//build the array to pass to is_callable
		$methodVariable = array($this, $functioName);
		
		//Make sure we can store a return value and have a default
		$result = '';
		
		//Check to see if our method is callable
		if ( is_callable($methodVariable, false, $callName))
		{
			$result = call_user_func($callName, $element);
		}
		//If not callable then use the default function
		else
		{
			$result = $this->renderInput($element);
		}
		
		return $result;
	}
	
	/**
	 * Gets the base class name.
	 * 
	 * If a value of 'Fuel\Fieldset\Element' is passed then 'Element'.
	 * If an object is passed rather than a string get_class() will be used
	 * to get the class name first.
	 * 
	 * This really should be moved to common
	 * 
	 * @param mixed $object
	 * @return string
	 */
	protected function getClassName($object)
	{
		if ( is_object($object) )
		{
			$object = get_class($object);
		}
		
		$nameArray = explode('\\', $object);
		
		return array_pop($nameArray);
	}
	
	/**
	 * Renders a single Input. This will be used as the generic fallback if no
	 * magic rendering method is found and therefore should always be implemented
	 * 
	 * @param Input $input The Input to render
	 * @return string
	 */
	public abstract function renderInput($input);
	
}
