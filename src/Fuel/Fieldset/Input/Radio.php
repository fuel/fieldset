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

/**
 * Defines a radio button
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Radio extends Toggle
{

	/**
	 * @param string $name
	 * @param array  $attributes
	 * @param mixed  $value
	 */
	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'radio';
		parent::__construct($name, $attributes, $value);
	}

}
