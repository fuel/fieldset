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
use Fuel\Common\Str;
use Fuel\Fieldset\AttributeTrait;
use Fuel\Fieldset\Input;
use Fuel\Fieldset\Render\Renderable;

/**
 * Defines a group of toggleable inputs such as checkboxes or radio buttons.
 *
 * @package Fuel\Fieldset\Input
 * @author Steve West
 */
abstract class ToggleGroup extends DataContainer implements Renderable
{
	use AttributeTrait;

	protected $autoArray = true;

	protected $name = '';

	protected $value;

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the name of this group. Any children added will have their name updated to match, as they are in the same
	 * group.
	 *
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;

		// Check if we need to make this an array
		if ($this->isAutoArray() && ! Str::endsWith($name, '[]'))
		{
			$this->name .= '[]';
		}

		// For any children, update the name
		foreach ($this->getContents() as $item)
		{
			$item->setName($this->name);
		}

		return $this;
	}

	/**
	 * Returns true or false to indicate the status of the auto array functionality
	 *
	 * @return bool
	 */
	public function isAutoArray()
	{
		return $this->autoArray;
	}

	/**
	 * Set to true to automatically add a set of square brackets onto the end of any name set to this ToggleGroup.
	 * The brackets will not be added if they already exist. Eg, "name" will become "name[]" whilst "green[]" will remain
	 * "green[]". Set this to false to disable this functionality.
	 *
	 * @param bool $status
	 *
	 * @throws \InvalidArgumentException
	 */
	public function setAutoArray($status)
	{
		if ( ! is_bool($status))
		{
			throw new \InvalidArgumentException('Auto array status must be boolean.');
		}

		$this->autoArray = $status;
	}

	/**
	 * Extends DataContainer's set method to ensure only Toggle objects can be added.
	 *
	 * @param string $key
	 * @param mixed  $value
	 *
	 * @return $this
	 *
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( ! $value instanceof Toggle)
		{
			throw new \InvalidArgumentException('You can only add Toggle objects to a ToggleGroup.');
		}

		return parent::set($key, $value);
	}

	/**
	 * Sets the value of the group, this will define which elements are selected or checked.
	 *
	 * @param mixed $value
	 *
	 * @return $this
	 */
	abstract public function setValue($value);

}
