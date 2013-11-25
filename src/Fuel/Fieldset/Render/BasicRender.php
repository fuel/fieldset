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

use Fuel\Common\Html;
use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;
use Fuel\Fieldset\InputElement;
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
 * @since   2.0
 * @author  Fuel Development Team
 */
class BasicRender extends Render
{

	protected $table;

	/**
	 * @param CSRFProvider $csrf
	 *
	 * @since 2.0
	 */
	public function __construct(CSRFProvider $csrf = null)
	{
		parent::__construct($csrf);

		$this->table = new Table;
	}

	/**
	 * @param InputElement|Select|ToggleGroup $element
	 *
	 * @since 2.0
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

		$name = $element->getName();
		$element->setAttribute('id', 'form_'.$name);

		$this->table->addCell($element->getLabel());
		$this->table->addCell($element->render($this));
		$this->table->addRow();

		return '';
	}

	/**
	 * Renders a RadioGroup into the table
	 *
	 * @param CheckboxGroup $radioGroup
	 *
	 * @since 2.0
	 */
	public function renderRadioGroup(RadioGroup $radioGroup)
	{
		return $this->renderToggleGroup($radioGroup);
	}

	/**
	 * Renders a CheckboxGroup into the table
	 *
	 * @param CheckboxGroup $radioGroup
	 *
	 * @since 2.0
	 */
	public function renderCheckboxGroup(CheckboxGroup $radioGroup)
	{
		return $this->renderToggleGroup($radioGroup);
	}

	/**
	 * Renders a ToggleGroup into the table
	 *
	 * @param ToggleGroup $group
	 *
	 * @since 2.0
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

		return '';
	}

	/**
	 * Adds a fieldset object to the table.
	 *
	 * @param  Fieldset $fieldset
	 *
	 * @since 2.0
	 */
	public function renderFieldset(Fieldset $fieldset)
	{
		// Create a new renderer and render the content
		$fieldsetRenderer = new static($this->csrfProvider);

		// Generate all the content
		foreach ($fieldset as $item)
		{
			$fieldsetRenderer->render($item);
		}

		$content = $fieldsetRenderer->getRenderedForm();

		// Create the fieldset tag and add the content
		$tag = Html::tag('fieldset', $fieldset->getAttributes(), $content);

		// Make sure everything is added to the parent table
		$cell = new Table\Cell($tag);
		$cell->setAttributes(['colspan' => 2]);

		$this->table->addCell($cell);
		$this->table->addRow();

		return '';
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
		foreach ($form as $element)
		{
			$this->render($element);
		}

		$tableRender = new SimpleTable();
		$tableContent = $tableRender->renderTable($this->table);

		return Html::tag('form', $form->getAttributes(), $tableContent);
	}

	/**
	 * Allows other BasicRenderes to get a rendered version of the table before things have finished.
	 *
	 * @since 2.0
	 */
	protected function getRenderedForm()
	{
		$tableRender = new SimpleTable();
		return $tableRender->renderTable($this->table);
	}

}
