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

use Fuel\Common\Html;
use Fuel\Fieldset\InputElement;
use Fuel\Fieldset\Render;

/**
 * Defines a text area element
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Textarea extends InputElement
{

	/**
	 * @param string $name
	 * @param array  $attributes
	 * @param mixed  $value
	 *
	 * @since 2.0
	 */
	public function __construct($name = '', array $attributes = [], $value = null)
	{
		parent::__construct($name, $attributes, $value);
		$this->setContents('');
	}

	/**
	 * Renders a textarea
	 *
	 * @param  Render $renderer
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function render(Render $renderer)
	{
		return Html::tag('textarea', $this->getAttributes(), $this->getContents());
	}

	/**
	 * Extends setValue to make sure content is set for correct repopulation.
	 *
	 * @param  string $value
	 *
	 * @return InputElement
	 *
	 * @since 2.0
	 */
	public function setValue($value)
	{
		$this->setContents($value);
		return parent::setValue($value);
	}

}
