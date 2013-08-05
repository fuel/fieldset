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

use Fuel\Common\Html;
use Fuel\Fieldset\Input;
use Fuel\Fieldset\Render;

/**
 * Defines a text area element
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Textarea extends Input
{

	public function __construct($name = '', array $attributes = [], $value = null)
	{
		parent::__construct($name, $attributes, $value);
		$this->setContent('');
	}

	/**
	 * Renders a textarea
	 *
	 * @param  Render $renderer
	 *
	 * @return string
	 */
	public function render(Render $renderer)
	{
		return $this->getLabel() . ' ' . Html::tag('textarea', $this->getAttributes(), $this->getContent());
	}

	/**
	 * Extends setValue to make sure content is set for correct repopulation.
	 *
	 * @param  string $value
	 *
	 * @return Input
	 */
	public function setValue($value)
	{
		$this->setContent($value);
		return parent::setValue($value);
	}

}
