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
 * Allows for the programtic construction of html forms.
 * 
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Form extends InputContainer
{
	
	//TODO: Use traits for this when able
	
	protected $attributes = array();
	
	/**
	 * Sets the attributes for the Input
	 * 
	 * @param array $attributes
	 * @return \FuelPHP\Fieldset\Input
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributes = \FuelPHP\Common\Arr::merge($this->attributes, $attributes);
		return $this;
	}
	
	/**
	 * Gets the attributes for the Input
	 * 
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}
	
}
