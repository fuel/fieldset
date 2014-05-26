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

use Fuel\Common\DataContainer;
use Fuel\Common\Html;
use Fuel\Fieldset\InputTrait;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Render;
use InvalidArgumentException;

/**
 * Defines a group of select options
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Optgroup extends DataContainer implements Renderable
{
	use InputTrait;

	/**
	 * Override the DataContainer's set function to enable type checking.
	 *
	 * @param string $key
	 * @param Option $value
	 *
	 * @return $this
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function set($key, $value)
	{
		if ( !($value instanceof Option) )
		{
			throw new InvalidArgumentException('Only Options can be added to an Optgroup.');
		}

		return parent::set($key, $value);
	}

	/**
	 * Renders out an optgroup and any child options
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function render(Render $renderer)
	{
		$content = '';

		foreach ( $this->getContents() as $option )
		{
			$content .= "\n" . $renderer->render($option);
		}

		return Html::tag('optgroup', $this->getAttributes(), $content);
	}

}
