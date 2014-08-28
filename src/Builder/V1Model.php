<?php
/**
 * @package   Fuel\Fieldset\Builder
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2014 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Builder;


use Fuel\Fieldset\InputContainer;
use Fuel\Fieldset\InputElement;
use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;

/**
 * Can construct forms from a v1 orm model
 *
 * @package Fuel\Fieldset\Builder
 * @author  Fuel Development Team
 * @since   2.0
 */
class V1Model implements BuilderInterface
{

	/**
	 * Controls what, if any, element the fields are wrapped in. Can be 'fieldset', 'form' or null to disable.
	 *
	 * @var string
	 */
	protected $wrapIn = 'form';

	/**
	 * @var Basic
	 */
	protected $builder;

	public function __construct()
	{
		$this->builder = new Basic;
	}

	/**
	 * Sets the element name
	 *
	 * @param $element
	 */
	public function setWrapperElement($element)
	{
		$this->wrapIn = $element;
	}

	/**
	 * Generates a form structure based on the given data.
	 *
	 * @param string $data Class name of a ORM model
	 *
	 * @return InputElement[]|Fieldset|Form
	 *
	 * @since 2.0
	 */
	public function generate($data)
	{
		// Get the model properties
		$properties = $data::properties();

		$elements = [];

		// Loop over each one and create+add them
		foreach ($properties as $name => $propertyConfig)
		{
			// If type = false then do not add.
			$type = \Arr::get($propertyConfig, 'form.type', 'text');

			if ($type === false)
			{
				continue;
			}

			// Build up a config array to pass to the parent
			$config = [
				'name' => $name,
				'label' => \Arr::get($propertyConfig, 'label', $name),
				'attributes' => \Arr::get($propertyConfig, 'form.attributes', []),
			];

			$content = \Arr::get($propertyConfig, 'form.options', false);

			if ($content !== false)
			{
				foreach ($content as $value => $contentName)
				{
					if (is_array($contentName))
					{
						$group = [
							'type' => 'optgroup',
							'label' => $value,
						];

						foreach ($contentName as $optValue => $optName)
						{
							$group['content'][] = [
								'type' => 'option',
								'value' => $optValue,
								'content' => $optName,
							];
						}

						$config['content'][] = $group;
					}
					else
					{
						$config['content'][] = [
							'type' => 'option',
							'value' => $value,
							'content' => $contentName,
						];
					}
				}
			}

			$instance = $this->builder->generateInput($type, $config);

			$elements[$name] = $instance;
		}

		// Create the wrapper element
		if ($this->wrapIn === null)
		{
			return $elements;
		}

		$wrapperClass = 'Fuel\\Fieldset\\' . ucfirst($this->wrapIn);
		/** @var InputContainer $wrapper */
		$wrapper = new $wrapperClass;
		$wrapper->setContents($elements);

		return $wrapper;
	}

	/**
	 * Register or override a custom element.
	 * This can be used to add custom form elements and replace existing ones.
	 *
	 * @param string $name
	 * @param string $class
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function registerElement($name, $class)
	{
		return $this->builder->registerElement($name, $class);
	}

	/**
	 * @param string $name
	 *
	 * @return InputElement
	 *
	 * @since 2.0
	 */
	public function getElementInstance($name)
	{
		return $this->builder->getElementInstance($name);
	}
}
