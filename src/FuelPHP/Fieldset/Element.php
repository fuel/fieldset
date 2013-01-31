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
class Element
{
	
	protected $_attributes = array();
	
	/**
	 * Sets the attributes for the Input
	 * 
	 * @param array $attributes
	 * @return \FuelPHP\Fieldset\Input
	 */
	public function setAttributes(array $attributes)
	{
		$this->_attributes = \FuelPHP\Common\Arr::merge($this->_attributes, $attributes);
		return $this;
	}
	
	/**
	 * Gets the attributes for the Input
	 * 
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->_attributes;
	}
}
