<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset\Render
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset\Render;

use Fuel\Fieldset\Render;
use Fuel\Fieldset\Form;
use Fuel\Fieldset;
use Fuel\Common\Html;

/**
 * Basic implementation of a fieldset renderer
 *
 * @package Fuel\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class BasicRender extends Render
{

	public function renderForm(Form $form)
	{
		$elements = '';

		foreach ( $form as $element )
		{
			$elements .= "\n" . $this->render($element);
		}

		return Html::tag('form', $form->getAttributes(), $elements);
	}

	public function renderFieldset(Fieldset $fieldset)
	{
		$legend = '';

		//Make sure the legend is added if needed
		if ( !is_null($fieldset->getlegend()) )
		{
			$legend = Html::tag('legend', array(), $fieldset->getlegend());
		}

		//Makes sure the legend is added if one exists
		$elements = $legend;

		//Render all the elements
		foreach ( $fieldset as $element )
		{
			$elements .= "\n" . $this->render($element);
		}

		return Html::tag('fieldset', $fieldset->getAttributes(), $elements);
	}

	public function renderInput($input)
	{
		return Html::tag('input', $input->getAttributes(), $input->getContent());
	}

	//Enable rendering for select elements
	public function renderSelect($select)
	{
		$content = '';

		foreach ( $select as $option )
		{
			$content .= "\n" . $this->render($option);
		}

		return Html::tag('select', $select->getAttributes(), $content);
	}

	public function renderOptgroup($group)
	{
		$content = '';

		foreach ( $group as $option )
		{
			$content .= "\n" . $this->render($option);
		}

		return Html::tag('optgroup', $group->getAttributes(), $content);
	}

	public function renderOption($option)
	{
		return Html::tag('option', $option->getAttributes(), $option->getContent());
	}

	public function renderTextarea($area)
	{
		return Html::tag('textarea', $area->getAttributes(), $area->getContent());
	}

}
