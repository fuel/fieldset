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

use FuelPHP\Fieldset\Input;

/**
 * Allows inputs to be togglable, such as checkbox or radiobuttons
 *
 * @package FuelPHP\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Toggle extends Input
{

	protected $_checked = false;

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
