<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset\Render
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Render;

/**
 * Basic implementation of a fieldset renderer
 *
 * @package FuelPHP\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class BasicRender extends \FuelPHP\Fieldset\Render
{

	public function form(\FuelPHP\Fieldset\Form $form, array $elements)
	{
		return \FuelPHP\Common\Html::forge()
			->tag('form', array(), implode("\n", $elements));
	}
	
	public function fieldset(\FuelPHP\Fieldset\Fieldset $fieldset, array $elements)
	{
		return \FuelPHP\Common\Html::forge()
			->tag('fieldset', array(), implode("\n", $elements));
	}

	public function input(\FuelPHP\Fieldset\Input $input)
	{
		return \FuelPHP\Common\Html::forge()
			->tag('input', $input->getAttributes());
	}
}
