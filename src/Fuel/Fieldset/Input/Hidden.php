<?php


namespace Fuel\Fieldset\Input;

use Fuel\Fieldset\Input;

/**
 * Defines a hidden input
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @since   2.0.0
 */
class Hidden extends Input
{

	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'hidden';
		parent::__construct($name, $attributes, $value);
	}

}
