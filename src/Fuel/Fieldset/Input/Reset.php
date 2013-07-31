<?php


namespace Fuel\Fieldset\Input;

use Fuel\Fieldset\Input;

/**
 * Defines a reset input
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class Reset extends Input
{

	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'reset';
		parent::__construct($name, $attributes, $value);
	}

}
