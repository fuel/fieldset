<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset\Input
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset\Input;

use Fuel\Fieldset\Input;

/**
 * Allows inputs to be toggleable, such as checkbox or radio buttons
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Toggle extends Input
{

	protected $_checked = false;

	/**
	 * @return bool true or false depending on the status of the input
	 */
	public function isChecked()
	{
		return $this->_checked;
	}

	/**
	 * Sets the status of this toggleable item
	 *
	 * @param  $status boolean
	 *
	 * @return $this Toggle
	 * @throws \InvalidArgumentException
	 */
	public function setChecked($status)
	{
		if ( ! is_bool($status) )
		{
			throw new \InvalidArgumentException('The status must be a boolean');
		}

		$this->_checked = $status;
		return $this;
	}

}
