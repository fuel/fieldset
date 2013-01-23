<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Render;

use FuelPHP\Fieldset\Fieldset;
use FuelPHP\Fieldset\Render\FieldsetRenderInterface;

/**
 * 
 *
 * @package FuelPHP\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Render
{
	
	/**
	 * @var \FuelPHP\Fieldset\Fieldset The Fieldset to be rendered
	 */
	protected $_fieldset;
	
	/**
	 * @var \FuelPHP\Fieldset\Render\FieldsetRenderInterface
	 */
	protected $_interface;
	
	/**
	 * Sets the Fieldset to be rendered.
	 * 
	 * @param \FuelPHP\Fieldset\Fieldset $fieldset
	 * @return \FuelPHP\Fieldset\Render
	 */
	public function setFieldset(Fieldset $fieldset)
	{
		$this->_fieldset = $fieldset;
		return $this;
	}
	
	/**
	 * The currently assigned Fieldset to render.
	 * @return \FuelPHP\Fieldset\Fieldset
	 */
	public function getFieldset()
	{
		return $this->_fieldset;
	}
	
	/**
	 * Sets the interface to render the Fieldset with
	 * 
	 * @param \FuelPHP\Fieldset\Render\FieldsetRenderInterface $interface
	 * @return \FuelPHP\Fieldset\Render\Render
	 */
	public function setInterface(FieldsetRenderInterface $interface)
	{
		$this->_interface = $interface;
		return $this;
	}
	
	/**
	 * Gets the currently assigned renderer interface.
	 * 
	 * @return \FuelPHP\Fieldset\Render\FieldsetRenderInterface
	 */
	public function getInterface()
	{
		return $this->_interface;
	}
	
	
}
