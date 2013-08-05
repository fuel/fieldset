<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset;

use Fuel\Common\Html;

/**
 * Allows for the programtic construction of html forms.
 * 
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Form extends InputContainer
{

	/**
	 * Should return a html string that represents the rendered object
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 */
	public function render(Render $renderer)
	{
		$elements = '';

		foreach ( $this->getContents() as $element )
		{
			$elements .= "\n" . $renderer->render($element);
		}

		return Html::tag('form', $this->getAttributes(), $elements);
	}

}
