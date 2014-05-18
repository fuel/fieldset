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
 *
 * TODO: Add proper support for things like
 */
class Basic extends AbstractBuilder
{

	/**
	 * Generates a form structure based on the given data.
	 *
	 * @return InputElement[]|Fieldset|Form
	 *
	 * @since 2.0
	 */
	public function generate()
	{
		$data = $this->getData();

		$result = [];

		// TODO: Clean this crap up
		foreach ($data as $type => $config)
		{
			if ($type == 'form')
			{
				$result[] = $this->generateForm($config);
			}
			elseif ($type == 'fieldset')
			{
				$result[] = $this->generateFieldset($config);
			}
			else
			{
				$result[] = $this->generateInput($type, $config);
			}
		}

		if (count($result) == 1)
		{
			$result = $result[0];
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
	public function generateForm($data)
	{
		/** @var Form $form */
		$form = new $this->formClass;

		if (array_key_exists('attributes', $data))
		{
			$form->setAttributes($data['attributes']);
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

		return $fieldset;
	}

	/**
	 * Attempts to generate an InputElement.
	 *
	 * @param string $type 'select', 'button', 'text', etc
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

		if (array_key_exists('name', $data))
		{
			$class->setName($data['name']);
		}

		return $class;
	}

}
