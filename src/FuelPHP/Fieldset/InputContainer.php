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

use FuelPHP\Common\DataContainer;
use FuelPHP\Fieldset\Render\Renderable;
use FuelPHP\Fieldset\Data\Input;

/**
 * Defines a common interface for objects that can handle input data
 * 
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class InputContainer extends DataContainer implements Renderable
{

	public function repopulate(Input $data = null)
	{
		if ( is_null($data) )
		{
			$data = new Input;
		}

		//Loop through all the elements assigned and attempt to assign a value
		//to them.
		foreach ( $this->all() as $item )
		{
			//Convert the name to a dot notation for better searching
			$key = $this->inputNameToKey($item->getName());
			$value = $data->input($key);
			if ( !is_null($value) )
			{
				$item->setValue($value);
			}
		}
	}

	protected function inputNameToKey($name)
	{
		return $name;
	}

}
