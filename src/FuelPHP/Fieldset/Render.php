<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Render;

/**
 * Defines a common interface for rendering fieldsets, forms and input attributes
 *
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class Render
{

	public function renderForm(\FuelPHP\Fieldset\Form $form)	
	{
	}
	
	//Render form with content
	public abstract function form(\FuelPHP\Fieldset\Form $form);
	
	//render fieldset with content
	public abstract function fieldset(\FuelPHP\Fieldset\Fieldset $fieldset);
	
	//render individual attributes
	public abstract function input(\FuelPHP\Fieldset\Input $input);
	
}
