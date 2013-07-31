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

use Fuel\Fieldset\Input;
use Fuel\Fieldset\Input\Textarea;
use Fuel\Fieldset\Input\Select;
use Fuel\Fieldset\Input\Optgroup;
use Fuel\Fieldset\Input\Option;
use Fuel\Fieldset\Input\RadioGroup;
use Fuel\Fieldset\Render;
use Fuel\Fieldset\Form;
use Fuel\Fieldset\Fieldset;
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

	/**
	 * Builds the main form tag and its content
	 *
	 * @param Form $form
	 *
	 * @return string <form>...</form>
	 */
	public function renderForm(Form $form)
	{
		$elements = '';

		foreach ( $form as $element )
		{
			$elements .= "\n" . $this->render($element);
		}

		return Html::tag('form', $form->getAttributes(), $elements);
	}

	/**
	 * Renders a fieldset object and its content
	 *
	 * @param Fieldset $fieldset
	 *
	 * @return string <fieldset>...</fieldset>
	 */
	public function renderFieldset(Fieldset $fieldset)
	{
		$legend = '';

		//Make sure the legend is added if needed
		if ( !is_null($fieldset->getLegend()) )
		{
			$legend = Html::tag('legend', array(), $fieldset->getLegend());
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

	/**
	 * Renders a any generic Input object
	 *
	 * @param Input $input
	 *
	 * @return string <input ...>
	 */
	public function renderInput(Input $input)
	{
		return Html::tag('input', $input->getAttributes(), $input->getContent());
	}

	/**
	 * Renders a select element and its options
	 *
	 * @param Select $select
	 *
	 * @return string <select>...</select>
	 */
	public function renderSelect(Select $select)
	{
		$content = '';

		foreach ( $select as $option )
		{
			$content .= "\n" . $this->render($option);
		}

		return Html::tag('select', $select->getAttributes(), $content);
	}

	/**
	 * Renders an option group for a select
	 *
	 * @param Optgroup $group
	 *
	 * @return string <optgroup>...</optgroup>
	 */
	public function renderOptgroup(Optgroup $group)
	{
		$content = '';

		foreach ( $group as $option )
		{
			$content .= "\n" . $this->render($option);
		}

		return Html::tag('optgroup', $group->getAttributes(), $content);
	}

	/**
	 * Renders a select option
	 *
	 * @param Option $option
	 *
	 * @return string <option>...</option>
	 */
	public function renderOption(Option $option)
	{
		return Html::tag('option', $option->getAttributes(), $option->getContent());
	}

	/**
	 * Renders a text area
	 *
	 * @param Textarea $area
	 *
	 * @return string <textarea>...</textarea>
	 */
	public function renderTextarea(Textarea $area)
	{
		return Html::tag('textarea', $area->getAttributes(), $area->getContent());
	}

	/**
	 * Renders a group of radio buttons
	 *
	 * @param RadioGroup $group
	 *
	 * @return string
	 */
	public function renderRadioGroup(RadioGroup $group)
	{
		$radios = '';
		foreach ($group as $radio)
		{
			$radios .= "\n" . $this->render($radio);
		}

		return $radios;
	}

}
