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
class Element implements Render\Renderable
{
	
	protected $_attributes = array();
	
	protected $_content = null;
	
	/**
	 * Sets the attributes for the Element
	 * 
	 * @param array $attributes
	 * @return \FuelPHP\Fieldset\Element
	 */
	public function setAttributes(array $attributes)
	{
		$this->_attributes = \FuelPHP\Common\Arr::merge($this->_attributes, $attributes);
		return $this;
	}
	
	/**
	 * Gets the attributes for the Element
	 * 
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->_attributes;
	}
	
	/**
	 * Gets the content of the Element
	 * 
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->_content;
	}
	
	/**
	 * Sets the content for this Element
	 * 
	 * @param mixed $content
	 * @return \FuelPHP\Fieldset\Element
	 */
	public function setContent($content)
	{
		$this->_content = $content;
		return $this;
	}
}
