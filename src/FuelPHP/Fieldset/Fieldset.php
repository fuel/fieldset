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
 * Defines a fieldset that can be added to a Form
 * 
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Fieldset extends InputContainer
{
	
	protected $_legend = null;
	
	/**
	 * Gets the legend for the Fieldset
	 * 
	 * @return string
	 */
	public function getlegend()
	{
		return $this->_legend;
	}
	
	/**
	 * Sets the legend for the Fieldset.
	 * 
	 * @param string|null $legend Set to null (the default) to not display a legend
	 * @return \FuelPHP\Fieldset\Fieldset
	 */
	public function setLegend($legend)
	{
		$this->_legend = $legend;
		
		return $this;
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
