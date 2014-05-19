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

/**
 * Common interface for fieldset builders
 *
 * @package Fuel\Fieldset\Builder
 * @author  Fuel Development Team
 * @since   2.0
 */
interface BuilderInterface
{

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
	public function registerElement($name, $class);

	/**
	 * @param string $name
	 *
	 * @return InputElement
	 *
	 * @since 2.0
	 */
	public function getElementInstance($name);

	/**
	 * Generates a form structure based on the given data.
	 *
	 * @param mixed $data Data to construct a form from
	 *
	 * @return Element|Fieldset|Form
	 *
	 * @since 2.0
	 */
	public function generate($data);

}
