<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset;

/**
 * Defines a common interface for rendering fieldsets, forms and input attributes
 *
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Render
{

	/**
	 * Renders a full form
	 * 
	 * @param Form $form The Form to render
	 * @return string
	 */
	public function renderForm(\FuelPHP\Fieldset\Form $form)
	{
		$elements = array();
		
		foreach($form as $element)
		{
			$elements[] = $this->renderElement($element);
		}
		
		$html = $this->form($form, $elements);
		
		return $html;
	}
	
	/**
	 * Renders a single form element. Usually a Fieldset or Input but could be
	 * expanded.
	 * 
	 * @param mixed $element
	 * @return string
	 */
	public function renderElement($element)
	{
		$html = '';
		
		if ($element instanceof \FuelPHP\Fieldset\Fieldset)
		{
			$html = $this->renderFieldset($element);
		}
		else if ($element instanceof \FuelPHP\Fieldset\Input)
		{
			$html = $this->input($element);
		}
		
		return $html;
	}
	
	/**
	 * Renders a fieldset element
	 * 
	 * @param \FuelPHP\Fieldset\Fieldset $fieldset
	 * @return string
	 */
	public function renderFieldset(\FuelPHP\Fieldset\Fieldset $fieldset)
	{
		$elements = array();
		
		foreach($fieldset as $element)
		{
			$elements[] = $this->renderElement($element);
		}
		
		return $this->fieldset($fieldset, $elements);
	}
	
	/**
	 * Renders the container form
	 * 
	 * @param Form $form The form to render
	 * @param array $elements The rendered version of elements that the form contains
	 * @return string
	 */
	public abstract function form(\FuelPHP\Fieldset\Form $form, array $elements);
	
	/**
	 * Renders a fieldset element and content
	 * 
	 * @param Fieldset $fieldset The fieldset to render
	 * @param array $elements The already rendered elements of the fieldset
	 * @return string
	 */
	public abstract function fieldset(\FuelPHP\Fieldset\Fieldset $fieldset, array $elements);
	
	/**
	 * Renders a single Input
	 * 
	 * @param Input $input The Input to render
	 * @return string
	 */
	public abstract function input(\FuelPHP\Fieldset\Input $input);
	
}
