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

use Fuel\Common\Arr;
use Fuel\Common\DataContainer;
use Fuel\Fieldset\AttributeTrait;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Input\Optgroup;
use Fuel\Fieldset\Input\Option;

/**
 * Defines a select box
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Select extends DataContainer implements Renderable
{
	use AttributeTrait;

	protected $value = null;

	protected $label = null;

	/**
	 * Gets the label for this select
	 *
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Sets the label for this select
	 *
	 * @param  string $label
	 *
	 * @return $this
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Override the DataContainer's set function to enable type checking.
	 * 
	 * @param string $key
	 * @param Option|Optgroup $value
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

	/**
	 * Sets the name of this select
	 *
	 * @param $name string
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->attributes['name'] = $name;
		return $this;
	}

	/**
	 * Gets the name of this select
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->attributes['name'];
	}

	/**
	 * Sets makes any options that have a value contained in $value have a "selected" attribute
	 *
	 * @param $value array[mixed]
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;

		$this->recursiveAssignValue($value, $this->getContents());

		return $this;
	}

	/**
	 * Recursive function to be able to handle Optgroups
	 *
	 * @param $value mixed
	 * @param $list array[Option|Optgroup]
	 */
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

	/**
	 * Sets the given Option as selected
	 *
	 * @param Option $option
	 */
	protected function assignSelected(Option $option)
	{
		$attributes = $option->getAttributes();
		$attributes[] = 'selected';
		$option->setAttributes($attributes);
	}

	/**
	 * Returns any selected values
	 *
	 * @return null|array Null if nothing has been selected
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Builds a select from an array
	 *
	 * @param array $config
	 *
	 * @return Select
	 */
	public static function fromArray($config)
	{
		$contentConfig = Arr::get($config, '_content', []);
		Arr::delete($config, '_content');

		$instance = new static();
		$instance->setAttributes($config);

		foreach ($contentConfig as $value => $name)
		{
			// Check if we are dealing with an opt group
			if (is_array($name))
			{
				$groupConfig = [
					'label' => $value,
					'_content' => $name,
				];

				$instance[] = Optgroup::fromArray($groupConfig);
			}
			else
			{
				$instance[] = new Option($name, $value);
			}
		}

		return $instance;
	}

}
