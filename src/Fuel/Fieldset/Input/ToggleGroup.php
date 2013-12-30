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

use Fuel\Common\DataContainer;
use Fuel\Common\Str;
use Fuel\Fieldset\InputTrait;
use Fuel\Fieldset\InputElement;
use Fuel\Fieldset\Render\Renderable;

/**
 * Defines a group of toggleable inputs such as checkboxes or radio buttons.
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @since   2.0
 */
abstract class ToggleGroup extends DataContainer implements Renderable
{
	use InputTrait {
		setName as itSetName;
	}

	protected $autoArray = false;

	protected $value;

	/**
	 * Sets the name of this group. Any children added will have their name updated to match, as they are in the same
	 * group.
	 *
	 * @param string $name
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setName($name)
	{
		// Check if we need to make this an array
		$endsWithBrackets = substr_compare($name, '[]', -2, 2) === 0;
		if ($this->isAutoArray() && ! $endsWithBrackets)
		{
			$name .= '[]';
		}

		$this->itSetName($name);

		// For any children, update the name
		foreach ($this->getContents() as $item)
		{
			$item->setName($this->getName());
		}

		return $this;
	}

	/**
	 * Returns true or false to indicate the status of the auto array functionality
	 *
	 * @return bool
	 *
	 * @since 2.0
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
	 * @param bool $status Default is false
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
	 *
	 * @since 2.0
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
	 * Gets the value assigned to the group.
	 *
	 * @return mixed
	 *
	 * @since 2.0
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Sets the value of the group, this will define which elements are selected or checked.
	 *
	 * @param mixed $value
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	abstract public function setValue($value);

}
