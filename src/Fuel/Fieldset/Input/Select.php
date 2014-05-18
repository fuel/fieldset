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
use Fuel\Fieldset\Input\Optgroup;
use Fuel\Fieldset\Input\Option;
use Fuel\Fieldset\Render;

/**
 * Defines a select box.
 * Please note that setting a value before setting options and optgroups can cause the necessary options to not be
 * selected when the form is rendered. Please make sure you call setValue() after adding all options.
 *
 * @package Fuel\Fieldset\Input
 * @since   2.0
 * @author  Fuel Development Team
 */
class Select extends DataContainer implements Renderable
{
	use InputTrait;

	protected $value = null;

	/**
	 * Override the DataContainer's set function to enable type checking.
	 *
	 * @param  string $key
	 * @param  Option|Optgroup $value
	 *
	 * @return $this
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function set($key, $value)
	{
		if ( !($value instanceof Option) &&
			!($value instanceof Optgroup) )
		{
			throw new \InvalidArgumentException('Only Options or Optgroups can be added to a Select.');
		}

		parent::set($key, $value);
		return $this;
	}

	/**
	 * Sets the name of this select
	 *
	 * @param  $name string
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setName($name)
	{
		$this->attributes['name'] = $name;
		return $this;
	}

	/**
	 * Gets the name of this select
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getName()
	{
		return $this->attributes['name'];
	}

	/**
	 * Sets makes any options that have a value contained in $values have a "selected" attribute
	 *
	 * @param $value array[mixed]
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setValue($value)
	{
		$this->value = $value;

		if ( ! is_array($value) )
		{
			$value = [$value];
		}

		$this->recursiveAssignValue($value, $this->getContents());

		return $this;
	}

	/**
	 * Recursive function to be able to handle Optgroups
	 *
	 * @param array[mixed]           $values
	 * @param array[Option|Optgroup] $list
	 *
	 * @since 2.0
	 */
	protected function recursiveAssignValue(array $values, $list)
	{
		//Loop through all the children and find out if one matches our value
		foreach ( $list as $item )
		{
			//Check if this is an option or group
			if ( $item instanceof Optgroup )
			{
				$this->recursiveAssignValue($values, $item->getContents());
			}

			//We have an option so check its value
			else if ( in_array($item->getValue(), $values) )
			{
				$this->assignSelected($item);
			}
		}
	}

	/**
	 * Sets the given Option as selected
	 *
	 * @param Option $option
	 *
	 * @since 2.0
	 */
	protected function assignSelected(Option $option)
	{
		$attributes = $option->getAttributes();
		$attributes[] = 'selected';
		$option->setAttributes($attributes);
	}

	/**
	 * Returns any selected values
	 *
	 * @return null|array Null if nothing has been selected
	 *
	 * @since 2.0
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Renders this select and any added options or optgroups
	 *
	 * @param  Render $renderer
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

		return Html::tag('select', $this->getAttributes(), $content);
	}

}
