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
	 * Contains the name of the Input
	 * 
	 * @var string 
	 */
	protected $_name = '';

	/**
	 * Creates a new Input object
	 *
	 * @param string  $name       Name to apply to this input
	 * @param array   $attributes A key=>value array of attributes
	 * @param mixed   $value      The initial value of the input, if any
	 */
	public function __construct($name = '', array $attributes = array(), $value = null)
	{
		$this->attributes['value'] = '';
		
		$this->setName($name);
		$this->setAttributes($attributes);
		$this->setValue($value);
	}
	
	/**
	 * Gets the name of this Input.
	 * 
	 * @return string
	 * @since 2.0.0
	 */
	public function getName()
	{
		return Arr::get($this->attributes, 'name', null);
	}
	
	/**
	 * Sets the name of the Input object
	 * 
	 * @param string $name
	 * @return Input
	 * @since 2.0.0
	 */
	public function setName($name)
	{
		if ( ! is_string($name) )
		{
			throw new InvalidArgumentException('The name must be a string');
		}
		
		$this->attributes['name'] = $name;
		return $this;
	}
	
	/**
	 * Gets the value of the Input object
	 * 
	 * @return string Null if no value has been set
	 * @since 2.0.0
	 */
	public function getValue()
	{
		return $this->attributes['value'];
	}
	
	/**
	 * Sets the value for the Input object
	 * 
	 * @param string $value
	 * @return Input
	 * @since 2.0.0
	 */
	public function setValue($value)
	{
		$this->attributes['value'] = $value;
		return $this;
	}

}
