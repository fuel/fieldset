<?php


namespace Fuel\Fieldset\Input;

use Fuel\Fieldset\Input;

/**
 * Defines a email input
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class Email extends Input
{

	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'email';
		parent::__construct($name, $attributes, $value);
	}

}
