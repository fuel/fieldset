<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset;

use Fuel\Fieldset\Render\Renderable;

/**
 * Defines common properties and functionality for input elements
 *
 * @package Fuel\Fieldset
 * @since   2.0
 * @author  Fuel Development Team
 */
abstract class Element implements Renderable
{
	use InputTrait;

	protected $content = null;

	/**
	 * Gets the content of the Element
	 *
	 * @return mixed
	 *
	 * @since 2.0
	 */
	public function getContents()
	{
		return $this->content;
	}

	/**
	 * Sets the content for this Element
	 *
	 * @param mixed $content
	 *
	 * @return Element
	 *
	 * @since 2.0
	 */
	public function setContent($content)
	{
		$this->content = $content;
		return $this;
	}

}
