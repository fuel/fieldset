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

/**
 * Allows for the programtic construction of html forms.
 * 
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Form extends InputContainer
{
	
	//TODO: Use traits for this when able
	
	protected $attributes = array(
		//Set the default action to post
		'method' => 'POST',
	);
	
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
