<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Input;

use Fuel\Common\Arr;
use Fuel\Fieldset\Input;

/**
 * Allows inputs to be toggleable, such as checkbox or radio buttons
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
abstract class Toggle extends Input
{

	/**
	 * @return bool true or false depending on the status of the input
	 */
	public function isChecked()
	{
		return Arr::get($this->attributes, 'checked', false);
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

		$this->attributes['checked'] = $status;

		return $this;
	}

}
