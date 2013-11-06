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
 * Defines a regular text input element
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Text extends Input
{

	/**
	 * @param string $name
	 * @param array  $attributes
	 * @param mixed  $value
	 */
	public function __construct($name = '', array $attributes = [], $value = null)
	{
		$attributes['type'] = 'text';
		parent::__construct($name, $attributes, $value);
	}

}
