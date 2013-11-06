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

use Fuel\Common\Arr;
use Fuel\Common\DataContainer;
use Fuel\Common\Html;
use Fuel\Fieldset\InputTrait;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Render;

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
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( !($value instanceof Option) )
		{
			throw new \InvalidArgumentException('Only Options can be added to an Optgroup.');
		}

		return parent::set($key, $value);
	}

	/**
	 * Constructs an Optgroup from the given config array
	 *
	 * @param  array $config
	 *
	 * @return Optgroup
	 */
	public static function fromArray($config)
	{
		$contentConfig = Arr::get($config, '_content', []);
		Arr::delete($config, '_content');

		$instance = new static();
		$instance->setAttributes($config);

		// Create all the options
		foreach ($contentConfig as $value => $name)
		{
			$instance[] = new Option($name, $value);
		}

		return $instance;
	}

	/**
	 * Renders out an optgroup and any child options
	 *
	 * @param Render $renderer
	 *
	 * @return string
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
