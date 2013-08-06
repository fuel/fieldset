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

use Fuel\Common\Html;
use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;
use Fuel\Fieldset\Input;
use Fuel\Fieldset\Input\Checkbox;
use Fuel\Fieldset\Input\CheckboxGroup;
use Fuel\Fieldset\Input\Optgroup;
use Fuel\Fieldset\Input\Option;
use Fuel\Fieldset\Input\Radio;
use Fuel\Fieldset\Input\RadioGroup;
use Fuel\Fieldset\Input\Select;
use Fuel\Fieldset\Input\ToggleGroup;
use Fuel\Fieldset\Render;
use Fuel\Common\Table;
use Fuel\Common\Table\Render\SimpleTable;
use Fuel\Fieldset\Security\CSRFProvider;

/**
 * Basic implementation of a fieldset renderer
 *
 * @package Fuel\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class BasicRender extends Render
{

	protected $table;

	public function __construct(CSRFProvider $csrf = null)
	{
		parent::__construct($csrf);

		$this->table = new Table;
	}

	/**
	 * @param Input|Select|ToggleGroup $element
	 */
	public function renderInput($element)
	{
		if ($element instanceof Option ||
			$element instanceof Optgroup ||
			$element instanceof Checkbox ||
			$element instanceof Radio )
		{
			return $element->render($this);
		}

		$this->table->addCell($element->getLabel());
		$this->table->addCell($element->render($this));
		$this->table->addRow();

		return '';
	}

	/**
	 * Renders a RadioGroup into the table
	 *
	 * @param CheckboxGroup $radioGroup
	 */
	public function renderRadioGroup(RadioGroup $radioGroup)
	{
		$this->renderToggleGroup($radioGroup);
	}

	/**
	 * Renders a CheckboxGroup into the table
	 *
	 * @param CheckboxGroup $radioGroup
	 */
	public function renderCheckboxGroup(CheckboxGroup $radioGroup)
	{
		$this->renderToggleGroup($radioGroup);
	}

	/**
	 * Renders a ToggleGroup into the table
	 *
	 * @param ToggleGroup $group
	 */
	protected function renderToggleGroup(ToggleGroup $group)
	{
		$groupLabel = $group->getLabel();

		$this->table->addCell($groupLabel);

		// Build all the radios
		$toggles = '';
		foreach ($group as $toggle)
		{
			$toggles .= $toggle->getLabel() . $toggle->render($this);
		}

		$this->table->addCell($toggles);

		$this->table->addRow();
	}

	// TODO: this
	public function renderFieldset(Fieldset $fieldset)
	{
		// TODO: something meaningful here
		return '';
	}

	/**
	 * Renders the whole form, wrapping a table in <form> tags.
	 *
	 * @param  Form $form
	 *
	 * @return string
	 */
	public function renderForm(Form $form)
	{
		foreach ($form as $element)
		{
			$this->render($element);
		}

		$tableRender = new SimpleTable();
		$tableContent = $tableRender->renderTable($this->table);

		return Html::tag('form', $form->getAttributes(), $tableContent);
	}

}
