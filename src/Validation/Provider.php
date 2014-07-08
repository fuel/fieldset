<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Validation;

use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;
use Fuel\Validation\RuleProvider\FromArray;

/**
 * Creates validation rules from fields
 *
 * @package Fuel\Fieldset\Validation
 * @author  Fuel Development Team
 *
 * @since 2.0
 */
class Provider extends FromArray
{

	public function __construct()
	{
		parent::__construct(true);
	}

	/**
	 * Adds some processing to turn input objects into arrays of validation rules
	 *
	 * @param Form|Fieldset|Input $element
	 *
	 * @return $this
	 */
	public function setData($element)
	{
		parent::setData($this->processRules($element));

		return $this;
	}

	/**
	 * Generates a rule set that the parent FromArray can parse for fields
	 *
	 * @param $element
	 *
	 * @return array
	 */
	protected function processRules($element)
	{
		// If this is a container (Form or Fieldset) loop through each of the fields
		if ($element instanceof Form or $element instanceof Fieldset)
		{
			$result = array();

			foreach ($element as $field)
			{
				$result += $this->processRules($field);
			}

			return $result;
		}

		$metaData = $element->getMetaContainer();

		if (isset($metaData['validation']))
		{
			$label = $element->getLabel();
			if ($label === null)
			{
				$label = $element->getName();
			}

			return array($element->getName() => [
				$this->ruleKey => $metaData['validation'],
				$this->labelKey => $label,
			]);
		}

		return array($element->getName() => array());
	}


}
