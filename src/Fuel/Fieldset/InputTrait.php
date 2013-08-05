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

	/**
	 * Gets an attribute
	 *
	 * @param  string $name
	 * @param  null   $default Default value to return if the attribute is not set
	 *
	 * @return mixed
	 */
	public function getAttribute($name, $default=null)
	{
		return Arr::get($this->attributes, $name, $default);
	}

	/**
	 * Sets the given attribute. If $value is null then $name is expected to be an array of attributes.
	 *
	 * @param  string|array $name
	 * @param  null|mixed   $value
	 *
	 * @return $this
	 */
	public function setAttribute($name, $value=null)
	{
		if (is_null($value))
		{
			return $this->setAttributes($name);
		}

		Arr::set($this->attributes, $name, $value);

		return $this;
	}

}
