<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Input;

use Fuel\Common\Html;
use Fuel\Fieldset\Render;
use Fuel\Fieldset\Input;

/**
 * Defines a select option
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Option extends Input
{

	/**
	 * @param mixed $content
	 * @param mixed $value
	 *
	 * @since 2.0
	 */
	public function __construct($content = null, $value = null)
	{
		parent::__construct();
		$this->setContent($content);

		if ( is_null($value) )
		{
			$value = $content;
		}

		$this->setValue($value);
		unset($this->attributes['name']);
	}

	/**
	 * Renders out a single option tag
	 *
	 * @param  Render $renderer
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function render(Render $renderer)
	{
		return Html::tag('option', $this->getAttributes(), $this->getContent());
	}

}
