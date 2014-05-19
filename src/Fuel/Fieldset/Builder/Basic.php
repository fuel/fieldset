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

use Fuel\Fieldset\InputElement;
use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;
use InvalidArgumentException;

/**
 * Can construct forms from an array structure
 *
 * @package Fuel\Fieldset\Builder
 * @author  Fuel Development Team
 * @since   2.0
 */
class Basic extends AbstractBuilder
{

	/**
	 * Generates a form structure based on the given data.
	 *
	 * @param array $data
	 *
	 * @return InputElement[]|Fieldset[]|Form[]
	 *
	 * @since 2.0
	 */
	public function generate($data)
	{
		$result = [];

		foreach ($data as $config)
		{
			$type = 'text';

			if (array_key_exists('type', $config))
			{
				$type = $config['type'];
			}

			$generateFunction = 'generate' . ucfirst($type);

			if (method_exists($this, $generateFunction))
			{
				$result[] = $this->$generateFunction($config);
			}
			else
			{
				$result[] = $this->generateInput($type, $config);
			}
		}

		return $result;
	}

	/**
	 * Attempts to generate a form from the given
	 *
	 * @param array $data
	 *
	 * @return Form
	 *
	 * @since 2.0
	 */
	public function generateForm(array $data)
	{
		/** @var Form $form */
		$form = new $this->formClass;

		if (array_key_exists('attributes', $data))
		{
			$form->setAttributes($data['attributes']);
		}

		if (array_key_exists('content', $data))
		{
			$content = $this->generate($data['content']);
			$form->setContents($content);
		}

		return $form;
	}

	/**
	 * @param $data
	 *
	 * @return Fieldset
	 *
	 * @since 2.0
	 */
	public function generateFieldset($data)
	{
		/** @var Fieldset $fieldset */
		$fieldset = new $this->fieldsetClass;

		if (array_key_exists('attributes', $data))
		{
			$fieldset->setAttributes($data['attributes']);
		}

		if (array_key_exists('legend', $data))
		{
			$fieldset->setLegend($data['legend']);
		}

		if (array_key_exists('content', $data))
		{
			$content = $this->generate($data['content']);
			$fieldset->setContents($content);
		}

		return $fieldset;
	}

	/**
	 * Attempts to generate an InputElement.
	 *
	 * @param string $type
	 * @param array  $data
	 *
	 * @return InputElement
	 *
	 * @throws InvalidArgumentException
	 *
	 * @since 2.0
	 */
	public function generateInput($type, array $data)
	{
		$class = $this->getElementInstance($type);

		if (array_key_exists('attributes', $data))
		{
			$class->setAttributes($data['attributes']);
		}

		if (array_key_exists('content', $data))
		{
			$class->setContents(
				  $this->generate($data['content'])
			);
		}

		if (array_key_exists('name', $data))
		{
			$class->setName($data['name']);
		}

		if (array_key_exists('value', $data))
		{
			$class->setValue($data['value']);
		}

		if (array_key_exists('label', $data))
		{
			$class->setLabel($data['label']);
		}

		return $class;
	}

	public function generateOption(array $data)
	{
		$content = $data['content'];
		unset($data['content']);

		$instance = $this->generateInput('option', $data);
		$instance->setContents($content);

		return $instance;
	}

}
