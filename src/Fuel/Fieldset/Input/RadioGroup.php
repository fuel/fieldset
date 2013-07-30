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

/**
 * Defines a group of radio buttons
 *
 * @package Fuel\Fieldset\Input
 * @author Fuel Development Team
 * @since 2.0.0
 */
class RadioGroup extends ToggleGroup
{

	/**
	 * Sets which radio button is checked
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		if ( ! is_string($value) && ! is_int($value))
		{
			throw new \InvalidArgumentException('A RadioGroup value must be a string or int');
		}

		$this->value = $value;

		// Work out which of our children need to be selected
		foreach ($this->getContents() as $item)
		{
			if ($item->getValue() == $value)
			{
				$item->setChecked(true);
			}
			else
			{
				$item->setChecked(false);
			}
		}

		return $this;
	}

	/**
	 * Extends the set method to ensure that only Radios can be added to a RadioGroup
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( ! $value instanceof Radio)
		{
			throw new \InvalidArgumentException('Only Radios can be added to a RadioGroup');
		}

		return parent::set($key, $value);
	}

}
