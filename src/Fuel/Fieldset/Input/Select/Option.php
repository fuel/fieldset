<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset\Input\Select
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset\Input\Select;

use Fuel\Fieldset\Input;

/**
 * Defines a select option
 *
 * @package Fuel\Fieldset\Input\Select
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Option extends Input
{

	public function __construct($content = null, $value = null)
	{
		parent::__construct();
		$this->setContent($content);

		if ( is_null($value) )
		{
			$value = $content;
		}

		$this->setValue($value);
		unset($this->attributes['name']);
	}

}
