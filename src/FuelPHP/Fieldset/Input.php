<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset;

/**
 * Defines common properties and functionality for input elements
 *
 * @package FuelPHP\Fieldset
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
	
	public function __construct(
		$name = '',
		array $attributes = array(), 
		$value = null)
	{
		$this->attributes['value'] = '';
		
		$this->setName($name);
		$this->setAttributes($attributes);
		$this->setValue($value);
	}
	
	/**
	 * Gets the name of this Input.
	 * 
	 * @return string Null if a name has not been set
	 * @since 2.0.0
	 */
	public function getName()
	{
		return \FuelPHP\Common\Arr::get($this->attributes, 'name', null);
	}
	
	/**
	 * Sets the name of the Input object
	 * 
	 * @param string $name
	 * @return \FuelPHP\Fieldset\Input
	 * @since 2.0.0
	 */
	public function setName($name)
	{
		if ( ! is_string($name) )
		{
			throw new \InvalidArgumentException('The name must be a string');
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
	 * @return \FuelPHP\Fieldset\Input
	 * @since 2.0.0
	 */
	public function setValue($value)
	{
		$this->attributes['value'] = $value;
		return $this;
	}

}
