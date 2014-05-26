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
use Fuel\Fieldset\InputElement;

abstract class AbstractBuilder implements BuilderInterface
{

	/**
	 * Base namespace to try loading input elements from
	 *
	 * @var string
	 */
	protected $baseElementNamespace = 'Fuel\Fieldset\Input\\';

	/**
	 * Defines the class to use when generating a form
	 *
	 * @var string
	 */
	protected $formClass = 'Fuel\Fieldset\Form';

	/**
	 * Defines the class to use when generating a fieldset
	 *
	 * @var string
	 */
	protected $fieldsetClass = 'Fuel\Fieldset\Fieldset';

	/**
	 * @var Element[]
	 */
	protected $customElements = [];

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
	 * @return InputElement
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
	 * @param mixed $data Data to construct a form from
	 *
	 * @return Element|Fieldset|Form
	 *
	 * @since 2.0
	 */
	abstract public function generate($data);

}
