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

/**
 * Provides a fluid interface for constructing forms.
 *
 * @package Fuel\Fieldset
 *
 * @since 2.0
 */
class FormBuilder
{

	/**
	 * Default namespace to try loading elements from
	 *
	 * @var string
	 */
	protected $elementNamespace = '\Fuel\Fieldset\Input\\';

	/**
	 * Contains class names for custom and overriden types
	 *
	 * @var array
	 */
	protected $customTypes = [];

	/**
	 * Gets a new instance of the given input type
	 *
	 * @param string $type
	 *
	 * @return InputElement
	 *
	 * @since 2.0
	 */
	public function getElementInstance($type)
	{
		$class = $this->elementNamespace . ucfirst($type);

		if (array_key_exists($type, $this->customTypes))
		{
			$class = $this->customTypes[$type];
		}

		// TODO: Throw exception if the class cannot be found
		return new $class;
	}

	/**
	 * Adds or overrides a form type with the given class
	 *
	 * @param string $name
	 * @param string $class
	 *
	 * @since 2.0
	 */
	public function addType($name, $class)
	{
		// TODO: Throw exception if we are not given a InputElement
		$this->customTypes[$name] = $class;
	}

}
