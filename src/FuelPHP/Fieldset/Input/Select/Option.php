<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset\Input\Select
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Input\Select;

use FuelPHP\Fieldset\Element;

/**
 * 
 *
 * @package FuelPHP\Fieldset\Input\Select
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Option extends Element
{

	public function __construct($content = null)
	{
		$this->setContent($content);
	}

}
