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

use Fuel\Common\Arr;
use Fuel\Common\Html;
use InvalidArgumentException;

/**
 * Defines common properties and functionality for input elements
 *
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Input extends Element
{

	/**
	 * Creates a new Input object
	 *
	 * @param string  $name       Name to apply to this input
	 * @param array   $attributes A key=>value array of attributes
	 * @param mixed   $value      The initial value of the input, if any
	 */
	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$this->attributes['value'] = '';
		
		$this->setName($name);
		$this->setAttributes($attributes);
		$this->setValue($value);
	}
	
	/**
	 * Gets the value of the Input object
	 * 
	 * @return string
	 * @since  2.0.0
	 */
	public function getValue()
	{
		return $this->attributes['value'];
	}
	
	/**
	 * Sets the value for the Input object
	 * 
	 * @param  string $value
	 * @return Input
	 * @since  2.0.0
	 */
	public function setValue($value)
	{
		$this->attributes['value'] = $value;
		return $this;
	}

	/**
	 * Returns an instance of this Input with the given settings
	 *
	 * @param array $config
	 */
	public static function fromArray($config = [])
	{
		if ( ! is_array($config))
		{
			throw new InvalidArgumentException('Config must be an array.');
		}

		$name = Arr::get($config, 'name', '');
		$value = Arr::get($config, 'value', null);

		return new static($name, $config, $value);
	}

	/**
	 * Renders a generic input
	 *
	 * @param Render $renderer
	 *
	 * @return string "<input type="..."
	 */
	public function render(Render $renderer)
	{
		return Html::tag('input', $this->getAttributes(), $this->getContent());
	}

}
