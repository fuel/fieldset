<?php


namespace Fuel\Fieldset\Input;

use Fuel\Common\Arr;
use Fuel\Fieldset\Render;

/**
 * Allows checkboxes to be grouped.
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @since   2.0.0
 */
class CheckboxGroup extends ToggleGroup
{

	protected $autoArray = true;

	/**
	 * Sets the value of the group, this will define which elements are selected or checked.
	 * If an array is given multiple checkboxes can be enabled.
	 *
	 * @param  mixed $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;

		$valueArray = [];
		if ( ! is_array($value) && ! $value instanceof \ArrayAccess)
		{
			$valueArray = [$value];
		}
		else
		{
			$valueArray = $value;
		}

		// Loop through the contents and make any checked that need to be
		foreach ($this->getContents() as $checkbox)
		{
			$checkboxValue = $checkbox->getValue();
			if (in_array($checkboxValue, $valueArray))
			{
				$checkbox->setChecked(true);
			}
			else
			{
				$checkbox->setChecked(false);
			}
		}

		return $this;
	}

	/**
	 * Extends the set method to ensure that only Checkboxs can be added to a CheckboxGroup
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( ! $value instanceof Checkbox)
		{
			throw new \InvalidArgumentException('Only Checkboxs can be added to a CheckboxGroup');
		}

		return parent::set($key, $value);
	}

	/**
	 * Constructs a group of checkboxes from an array
	 *
	 * @param array $config
	 *
	 * @return CheckboxGroup
	 */
	public static function fromArray($config)
	{
		$contentConfig = Arr::get($config, '_content', []);
		Arr::delete($config, '_content');

		$instance = new static();
		$instance->setAttributes($config);

		// Add any checkboxes
		foreach ($contentConfig as $value => $name)
		{
			$checkbox = new Checkbox('', [], $value);
			$checkbox->setLabel($name);
			$instance[] = $checkbox;
		}

		$name = Arr::get($config, 'name', false);

		// If there is a name make sure it's set
		if ($name !== false)
		{
			$instance->setName($name);
		}

		return $instance;
	}

	/**
	 * Renders a group of checkboxes to html
	 *
	 * @param Render $renderer
	 *
	 * @return string
	 */
	public function render(Render $renderer)
	{
		$checkboxes = [];

		// Render all the boxes
		foreach ($this->getContents() as $checkbox)
		{
			$checkboxes[] = $renderer->render($checkbox);
		}

		return implode('', $checkboxes);
	}

}
