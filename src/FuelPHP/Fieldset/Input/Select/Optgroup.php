<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset\Input\Select
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Input\Select;

/**
 * 
 *
 * @package FuelPHP\Fieldset\Input\Select
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Optgroup
	extends \FuelPHP\Common\DataContainer
	implements \FuelPHP\Fieldset\Render\Renderable
{
	
	/**
	 * Override the DataContainer's set function to enable type checking.
	 * 
	 * @param string $key
	 * @param Select\Option $value
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if( ! ($value instanceof Option) )
		{
			throw new \InvalidArgumentException('Only Options can be added to an Optgroup.');
		}
		
		return parent::set($key, $value);
	}
	
	//TODO: Use traits for this when able
	
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
