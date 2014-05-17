<?php
/**
 * @package   Fuel\Fieldset\Builder
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2014 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Builder;

use Fuel\Fieldset\Element;
use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;

abstract class AbstractBuilder
{
	/**
	 * Contains the array to define the form structure
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Base namespace to try loading input elements from
	 *
	 * @var string
	 */
	protected $baseElementNamespace = 'Fuel\Fieldset\Input\\';

	/**
	 * @var Element[]
	 */
	protected $customElements = [];

	/**
	 * Creates a new builder with optional data to work with.
	 *
	 * @param array $data
	 *
	 * @since 2.0
	 */
	public function __construct($data = [])
	{
		$this->setData($data);
	}

	/**
	 * Set the data to work with.
	 *
	 * @param $data
	 *
	 * @since 2.0
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * Get the current data set
	 *
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Register or override a custom element.
	 * This can be used to add custom form elements and replace existing ones.
	 *
	 * @param string $name
	 * @param string $class
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function registerElement($name, $class)
	{
		$this->customElements[$name] = $class;

		return $this;
	}

	/**
	 * @param string $name
	 *
	 * @return Element
	 *
	 * @since 2.0
	 */
	public function getElementInstance($name)
	{
		$className = $this->baseElementNamespace . ucfirst($name);

		if (array_key_exists($name, $this->customElements))
		{
			$className = $this->customElements[$name];
		}

		return new $className;
	}

	/**
	 * Generates a form structure based on the given data.
	 *
	 * @return Element|Fieldset|Form
	 *
	 * @since 2.0
	 */
	abstract public function generate();
}
