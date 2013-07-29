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
 * Simple trait to allow form elements to have attributes assigned easily
 * TODO: allow for setting/getting of individual attributes
 *
 * @package Fuel\Fieldset
 * @author Fuel Development Team
 * @since 2.0.0
 */
trait AttributeTrait
{

	protected $_attributes = array();

	/**
	 * Sets the attributes for the Input
	 *
	 * @param array $attributes
	 * @return $this
	 */
	public function setAttributes(array $attributes)
	{
		$this->_attributes = \Fuel\Common\Arr::merge($this->_attributes, $attributes);
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
