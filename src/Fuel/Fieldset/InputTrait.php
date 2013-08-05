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

use Fuel\Common\Arr;

/**
 * Simple trait to allow form elements to have attributes assigned easily
 * TODO: allow for setting/getting of individual attributes
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 * @since   2.0.0
 */
trait InputTrait
{

	protected $attributes = [
		'name' => '',
	];

	protected $label = null;

	/**
	 * Gets the label of this group
	 *
	 * @return mixed
	 */
	public function getLabel()
	{
		// Checks if the object has a label
		$label = $this->label;

		// if not guess one from the name
		if (is_null($label))
		{
			$label = $this->getName();
		}

		return $label;
	}

	/**
	 * Sets the label for this group
	 *
	 * @param mixed $label
	 *
	 * @return $this
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Sets the attributes for the Input
	 *
	 * @param array $attributes
	 * @return $this
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributes = \Fuel\Common\Arr::merge($this->attributes, $attributes);
		return $this;
	}

	/**
	 * Gets the attributes for the Input
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Gets the name of this input
	 *
	 * @return string
	 */
	public function getName()
	{
		return Arr::get($this->attributes, 'name');
	}

	/**
	 * Sets the name of this input
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		if ( ! is_string($name))
		{
			throw new \InvalidArgumentException('The name must be a string');
		}

		Arr::set($this->attributes, 'name', $name);
	}

}
