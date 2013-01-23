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
 * Defines a common interface for rendering fieldsets, forms and input attributes
 *
 * @package FuelPHP\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
interface FieldsetRenderInterface
{
	
	//Render form with content
	public function form($fieldsets, $attributes = array());
	
	//render fieldset with content
	public function fieldset($fields, $attributes = array());
	
	//render individual attributes
	public function input($attributes);
	
	//Render block of HTML
	public function html($html);
	
}
