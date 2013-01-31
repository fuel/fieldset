<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset\Input
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Input;

/**
 * 
 *
 * @package FuelPHP\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Checkbox extends \FuelPHP\Fieldset\Input
{
	
	protected $_checked = false;
	
	public function __construct($name = '', array $attributes = array(), $value = null)
	{
		$attributes['type'] = 'checkbox';
		parent::__construct($name, $attributes, $value);
	}
	
	public function isChecked()
	{
		return $this->_checked;
	}
	
	public function setChecked($status)
	{
		if ( !is_bool($status) )
		{
			throw new \InvalidArgumentException('The status must be a boolean');
		}
		
		$this->_checked = $status;
		return $this;
	}
	
}
