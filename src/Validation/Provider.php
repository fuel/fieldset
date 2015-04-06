<?php
/**
 * @package    Fuel\Fieldset
 * @version    2.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Fieldset\Validation;

use Fuel\Fieldset\Fieldset;
use Fuel\Fieldset\Form;
use Fuel\Validation\RuleProvider\FromArray;
use Fuel\Validation\ValidationAwareInterface;
use Fuel\Validation\Validator;

/**
 * Creates validation rules from fields
 */
class Provider implements ValidationAwareInterface
{
	/**
	 * @var FromArray
	 */
	protected $ruleProvider;

	/**
	 * @param FromArray|null $ruleProvider
	 */
	public function __construct(FromArray $ruleProvider = null)
	{
		if (is_null($ruleProvider))
		{
			$ruleProvider = new FromArray(true);
		}

		$this->ruleProvider = $ruleProvider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function populateValidator(Validator $validator)
	{
		return $this->ruleProvider->populateValidator($validator);
	}

	/**
	 * Adds some processing to turn input objects into arrays of validation rules
	 *
	 * @param Form|Fieldset|Input $element
	 *
	 * @return self
	 */
	public function setData($element)
	{
		$rules = $this->processRules($element);

		$this->ruleProvider->setData($rules);

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
			$result = [];

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

			if (is_null($label))
			{
				$label = $element->getName();
			}

			return [$element->getName() => [
				$this->ruleProvider->getRuleKey() => $metaData['validation'],
				$this->ruleProvider->getLabelKey() => $label,
			]];
		}

		return [$element->getName() => []];
	}
}
