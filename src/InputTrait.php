<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset;

use Fuel\Common\Arr;
use InvalidArgumentException;

/**
 * Simple trait to allow form elements to have attributes assigned easily
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 * @since   2.0
 */
trait InputTrait
{

	/**
	 * Container for any attributes
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Used to contain any meta information to associate with this input
	 *
	 * @var array
	 */
	protected $metaContainer = [];

	protected $label = null;

	/**
	 * Gets the label of this group
	 *
	 * @return mixed
	 *
	 * @since 2.0
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
	 *
	 * @since 2.0
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Sets the attributes for the InputElement
	 *
	 * @param  array $attributes
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributes = array_merge($this->attributes, $attributes);
		return $this;
	}

	/**
	 * Gets the attributes for the InputElement
	 *
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Gets the name of this input
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getName()
	{
		return Arr::get($this->attributes, 'name', '');
	}

	/**
	 * Sets the name of this input
	 *
	 * @param  string $name
	 *
	 * @return $this
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function setName($name)
	{
		if ( ! is_string($name))
		{
			throw new \InvalidArgumentException('The name must be a string');
		}

		Arr::set($this->attributes, 'name', $name);

		return $this;
	}

	/**
	 * Gets an attribute
	 *
	 * @param  string     $name
	 * @param  null|mixed $default Default value to return if the attribute is not set
	 *
	 * @return mixed
	 *
	 * @since 2.0
	 */
	public function getAttribute($name, $default = null)
	{
		return Arr::get($this->attributes, $name, $default);
	}

	/**
	 * Sets the given attribute. If $value is null then $name is expected to be an array of attributes.
	 *
	 * @param  string $name
	 * @param  string   $value
	 *
	 * @return $this
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function setAttribute($name, $value = null)
	{
		if (is_null($value))
		{
			if ( ! is_array($name))
			{
				throw new InvalidArgumentException('If the value is null then name must be an array');
			}

			return $this->setAttributes($name);
		}

		Arr::set($this->attributes, $name, $value);

		return $this;
	}

	/**
	 * @param string     $key
	 * @param null|mixed $value
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setMeta($key, $value = null)
	{
		Arr::set($this->metaContainer, $key, $value);
		return $this;
	}

	/**
	 * Returns any meta data associated with this input.
	 *
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getMetaContainer()
	{
		return $this->metaContainer;
	}

	/**
	 * @param string $key
	 * @param null   $default
	 *
	 * @return mixed
	 *
	 * @since 2.0
	 */
	public function getMeta($key, $default = null)
	{
		return Arr::get($this->metaContainer, $key, $default);
	}

}
