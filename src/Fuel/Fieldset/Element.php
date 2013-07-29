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

use Fuel\Fieldset\Render\Renderable;

/**
 * Defines common properties and functionality for input elements
 *
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Element implements Renderable
{
	use AttributeTrait;

	protected $content = null;

	/**
	 * Gets the content of the Element
	 * 
	 * @return mixed
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Sets the content for this Element
	 * 
	 * @param  mixed $content
	 * @return Element
	 */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

}
