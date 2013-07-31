<?php


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
