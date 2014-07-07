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

use Fuel\Common\Html;

/**
 * Allows for the programmatic construction of html forms.
 *
 * @package Fuel\Fieldset
 * @since   2.0
 * @author  Fuel Development Team
 */
class Form extends InputContainer
{

	/**
	 * @var Render
	 */
	protected $renderer;
	
	/**
	 * @param Render $renderer
	 */
	public function setRenderer(Render $renderer)
	{
		$this->renderer = $renderer;
	}

	/**
	 * Should return a html string that represents the rendered object
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function render(Render $renderer = null)
	{
		$renderer = $renderer ?: $this->renderer;

		$elements = '';

		foreach ( $this->getContents() as $element )
		{
			$elements .= "\n" . $renderer->render($element);
		}

		return Html::tag('form', $this->getAttributes(), $elements);
	}

	/**
	 * Should return a html string of one emement
	 * 
	 * @param string $name
	 * @return string
	 */
	public function renderElement($name)
	{
		return $this->get($name)->render($this->renderer);
	}

	/**
	 * Should return label text of one emement
	 * 
	 * @param string $name
	 * @return string
	 */
	public function getElementLabel($name)
	{
		return $this->get($name)->getLabel();
	}
}
