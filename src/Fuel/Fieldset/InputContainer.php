<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset;

use Fuel\Common\DataContainer;
use Fuel\Common\Arr;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Data\Input;

/**
 * Defines a common interface for objects that can handle input data
 * 
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class InputContainer extends DataContainer implements Renderable
{

	/**
	 * Repopulates the fields using input data. By default uses a combination
	 * of get and post but other data can be used by passing a child of Input
	 * 
	 * @param \Fuel\Fieldset\Data\Input $data
	 */
	public function repopulate(Input $data = null)
	{
		if ( is_null($data) )
		{
			$data = new Input;
		}

		$this->populate($data->input());
		
		return $this;
	}

	/**
	 * Populates the fields using the array passed.
	 * 
	 * @param array $data The data to use for population.
	 * @return \Fuel\Fieldset\InputContainer
	 */
	public function populate($data)
	{
		//Loop through all the elements assigned and attempt to assign a value
		//to them.
		foreach ( $this->getContents() as $item )
		{
			//Convert the name to a dot notation for better searching
			$key = $this->inputNameToKey($item->getName());
			$value = Arr::get($data, $key);
			if ( !is_null($value) )
			{
				$item->setValue($value);
			}
		}
		
		return $this;
	}

	/**
	 * Helper function to convert html array'd input names into dot notation for
	 * easy access.
	 * 
	 * @param type $name
	 * @return type
	 */
	public function inputNameToKey($name)
	{
		$key = str_replace(array('[', ']'), array('.', ''), $name);
		return $key;
	}

}
