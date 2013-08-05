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

/**
 * Allows an object to be processed by Render.
 *
 * @package Fuel\Fieldset\Render
 * @since   2.0.0
 * @author  Fuel Development Team
 */
interface Renderable
{

	/**
	 * Should return a html string that represents the rendered object
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 */
	public function render(Render $renderer);

}

