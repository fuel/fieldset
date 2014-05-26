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

use Fuel\Fieldset\Render;

/**
 * Allows checkboxes to be grouped.
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @since   2.0
 */
class CheckboxGroup extends ToggleGroup
{

	protected $autoArray = true;

	/**
	 * Sets the value of the group, this will define which elements are selected or checked.
	 * If an array is given multiple checkboxes can be enabled.
	 *
	 * @param  mixed $value
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setValue($value)
	{
		$this->value = $value;

		if ( ! is_array($value) && ! $value instanceof \ArrayAccess)
		{
			$valueArray = [$value];
		}
		else
		{
			$valueArray = $value;
		}

		// Loop through the contents and make any checked that need to be
		foreach ($this->getContents() as $checkbox)
		{
			$checkboxValue = $checkbox->getValue();
			if (in_array($checkboxValue, $valueArray))
			{
				$checkbox->setChecked(true);
			}
			else
			{
				$checkbox->setChecked(false);
			}
		}

		return $this;
	}

	/**
	 * Extends the set method to ensure that only Checkboxs can be added to a CheckboxGroup
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return $this
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function set($key, $value)
	{
		if ( ! $value instanceof Checkbox)
		{
			throw new \InvalidArgumentException('Only Checkboxs can be added to a CheckboxGroup');
		}

		return parent::set($key, $value);
	}

	/**
	 * Renders a group of checkboxes to html
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function render(Render $renderer)
	{
		$checkboxes = [];

		// Render all the boxes
		foreach ($this->getContents() as $checkbox)
		{
			$checkboxes[] = $renderer->render($checkbox);
		}

		return implode('', $checkboxes);
	}

}
