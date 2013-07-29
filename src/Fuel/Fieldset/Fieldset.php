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
 * Defines a fieldset that can be added to a Form
 * 
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Fieldset extends InputContainer
{
	use AttributeTrait;
	
	protected $_legend = null;
	
	/**
	 * Gets the legend for the Fieldset
	 * 
	 * @return string
	 */
	public function getLegend()
	{
		return $this->_legend;
	}
	
	/**
	 * Sets the legend for the Fieldset.
	 * 
	 * @param string|null $legend Set to null (the default) to not display a legend
	 * @return Fieldset
	 */
	public function setLegend($legend)
	{
		$this->_legend = $legend;
		
		return $this;
	}
	
}
