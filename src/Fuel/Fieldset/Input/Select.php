<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset\Input
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset\Input;

use Fuel\Common\DataContainer;
use Fuel\Fieldset\AttributeTrait;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Input\Select\Optgroup;
use Fuel\Fieldset\Input\Select\Option;

/**
 * 
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Select extends DataContainer implements Renderable
{
	use AttributeTrait;

	protected $value = null;

	/**
	 * Override the DataContainer's set function to enable type checking.
	 * 
	 * @param string $key
	 * @param Select\Option|Select\Optgroup $value
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( !($value instanceof Option) &&
			!($value instanceof Optgroup) )
		{
			throw new \InvalidArgumentException('Only Options or Optgroups can be added to a Select.');
		}

		return parent::set($key, $value);
	}

	public function setName($name)
	{
		$this->attributes['name'] = $name;
		return $this;
	}

	public function getName()
	{
		return $this->attributes['name'];
	}

	public function setValue($value)
	{
		$this->value = $value;

		$this->recursiveAssignValue($value, $this->getContents());

		return $this;
	}

	protected function recursiveAssignValue($value, $list)
	{
		//Loop through all the children and find out if one matches our value
		foreach ( $list as $item )
		{
			//Check if this is an option or group
			if ( $item instanceof Optgroup )
			{
				$this->recursiveAssignValue($value, $item->getContents());
			}

			//We have an option so check its value
			else if ( $item->getValue() === $value )
			{
				$this->assignSelected($item);
			}
		}
	}

	protected function assignSelected($option)
	{
		$attributes = $option->getAttributes();
		$attributes[] = 'selected';
		$option->setAttributes($attributes);
	}

	public function getValue()
	{
		return $this->value;
	}

}
