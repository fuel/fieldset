<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Render;

use Fuel\Fieldset\Input\Select;
use Fuel\Fieldset\Input\Submit;
use Fuel\Fieldset\Render;
use Fuel\Fieldset\Form;
use Fuel\Fieldset\Fieldset;
use Fuel\Common\Html;
use Fuel\Fieldset\Input\Button;
use Fuel\Fieldset\Input\Checkbox;
use Fuel\Fieldset\Input\Option;
use Fuel\Fieldset\Input\Optgroup;
use Fuel\Fieldset\Input\Radio;

/**
 * Renders a form in the format required by bootstrap 3
 *
 * @package Fuel\Fieldset\Render
 * @since   2.0
 * @author  Fuel Development Team
 */
class Bootstrap3 extends Render
{

	/**
	 * @param InputElement|Select|ToggleGroup $element
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function renderInput($element)
	{
		if ($element instanceof Fieldset ||
		    $element instanceof Option ||
			$element instanceof Optgroup ||
			$element instanceof Radio )
		{
			return $element->render($this);
		}

		$element->setAttribute(
			'class',
			trim($element->getAttribute('class') . ' form-control')
		);

		$name = $element->getName();
		$element->setAttribute('id', 'form_'.$name);

		$elementHtml = $element->render($this);

		$renderGroup = $element->getMeta('group', true);

		$content = '';

		if ($renderGroup)
		{
			$content = '<div class="form-group">';
		}

		if (trim($element->getLabel()) != '')
		{
			$content .= '<label for="'.$element->getAttribute('id').'">'.$element->getLabel().'</label>';
		}

		$content .= $elementHtml;

		if ($renderGroup)
		{
			$content .= '</div>';
		}

		return $content;
	}

	/**
	 * Renders the whole form, wrapping a table in <form> tags.
	 *
	 * @param  Form $form
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function renderForm(Form $form)
	{
		$content = '';
		foreach ($form as $element)
		{
			$content .= $this->render($element);
		}

		$form->setAttribute('role', 'form');

		return Html::tag('form', $form->getAttributes(), $content);
	}

	/**
	 * Renders a basic checkbox
	 *
	 * @param $checkbox Checkbox
	 *
	 * @return string
	 *
	 * @since 2.0
 	 */
	public function renderCheckbox(Checkbox $checkbox)
	{
		$content = '<div class="checkbox"><label>';
		$content .= $checkbox->render($this);
		$content .= $checkbox->getLabel();
		$content .= '</label></div>';

		return $content;
	}

	/**
	 * Renders a submit with the appropriate classes.
	 *
	 * @param Submit $select
	 *
	 * @return string
	 */
	public function renderSubmit(Submit $select)
	{
		$attributes = $select->getAttributes();

		if ( ! isset($attributes['class']))
		{
			$attributes['class'] = '';
		}

		$attributes['class'] .= ' btn btn-default';

		return Html::tag('button', $attributes, $select->getValue());
	}

	/**
	 * Renders a button
	 *
	 * @param Button $button
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function renderButton(Button $button)
	{
		$button->setAttribute(
			'class',
			trim($button->getAttribute('class') . ' btn btn-default')
		);

		return $button->render($this);
	}

}
