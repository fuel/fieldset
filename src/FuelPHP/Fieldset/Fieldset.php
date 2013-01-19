<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset;

/**
 * Allows for the programtic construction of html forms.
 * 
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Steve "uru" West <uruwolf@gmail.com>
 */
class Fieldset extends \FuelPHP\Common\DataContainer
{
	
	/**
	 * Override the DataContainer's set function to enable type checking.
	 * 
	 * @param string $key
	 * @param Input|Fieldset $value
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		var_dump($value);
		
		if( ! ($value instanceof Input) && ! ($value instanceof Fieldset) )
		{
			throw new \InvalidArgumentException('Only Inputs or Fieldsets can be added to a Fieldset.');
		}
		
		parent::set($key, $value);
	}
	
}
