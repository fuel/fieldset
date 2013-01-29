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
	 */
	public function renderForm(\FuelPHP\Fieldset\Form $form)
	{
		$elements = array();
		
		foreach($form as $element)
		{
			if ($element instanceof \FuelPHP\Fieldset\Fieldset)
			{
				$elements[] = $this->renderFieldset($element);
			}
			else if ($element instanceof \FuelPHP\Fieldset\Input)
			{
				$elements[] = $this->input($element);
			}
		}
		
		$html = $this->form($form, $elements);
		
		return $html;
	}
	
	public function renderFieldset(\FuelPHP\Fieldset\Fieldset $fieldset)
	{
		
	}
	
	//Render form with content
	public abstract function form(\FuelPHP\Fieldset\Form $form, array $elements);
	
	//render fieldset with content
	public abstract function fieldset(\FuelPHP\Fieldset\Fieldset $fieldset);
	
	//render individual attributes
	public abstract function input(\FuelPHP\Fieldset\Input $input);
	
}
