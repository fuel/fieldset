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

use Fuel\Fieldset\Input;

/**
 * Defines a button input
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class Button extends Input
{

	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'button';
		parent::__construct($name, $attributes, $value);
	}

}
