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

use Codeception\TestCase\Test;
use Fuel\Fieldset\Input\Option;

/**
 * Class BasicTest
 *
 * @package Fuel\Fieldset\Builder
 * @author  Fuel Development Team
 *
 * @coversDefaultClass  \Fuel\Fieldset\Builder\Basic
 */
class BasicTest extends Test
{

	/**
	 * @var Basic
	 */
	protected $builder;

	public function _before()
	{
		$this->builder = new Basic;
	}

	/**
	 * @covers ::generateInput
	 * @group  Fieldset
	 */
	public function testGenerateSingleElement()
	{
		$type = 'submit';
		$name = 'send';
		$value = 'GO!';

		$config = [
			'name' => $name,
			'value' => $value,
			'attributes' => [
				'blue' => 'green',
			],
		];

		$submit = $this->builder->generateInput($type, $config);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$submit
		);

		$this->assertEquals(
			$name,
			$submit->getName()
		);

		$this->assertEquals(
			[
				'value' => $value,
				'name' => $name,
				'type' => $type,
				'blue' => 'green',
			],
			$submit->getAttributes()
		);
	}

	/**
	 * @covers ::generateForm
	 * @covers ::generate
	 * @group  Fieldset
	 */
	public function testCreateForm()
	{
		$attributes = [
			'action' => 'foo/bar',
			'method' => 'POST',
		];

		$config = [
			'attributes' => $attributes,
			'content' => [
				[
					'type' => 'submit',
				],
			],
		];

		$form = $this->builder->generateForm($config);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Form',
			$form
		);

		$this->assertEquals(
			$attributes,
			$form->getAttributes()
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$form[0]
		);
	}

	/**
	 * @covers ::generateFieldset
	 * @covers ::generate
	 * @group  Fieldset
	 */
	public function testCreateFieldset()
	{
		$attributes = [
			'action' => 'foo/bar',
			'method' => 'POST',
		];
		$legend = 'Epic!';

		$config = [
			'attributes' => $attributes,
			'legend' => $legend,
			'content' => [
				[
					'type' => 'submit'
				],
			],
		];

		$fieldset = $this->builder->generateFieldset($config);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Fieldset',
			$fieldset
		);

		$this->assertEquals(
			$attributes,
			$fieldset->getAttributes()
		);

		$this->assertEquals(
			$legend,
			$fieldset->getLegend()
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$fieldset[0]
		);
	}

	/**
	 * @covers ::generate
	 * @covers ::generateInput
	 * @group  Fieldset
	 */
	public function testCreatingSelect()
	{
		$name = 'myselect';
		$config = [[
			'type' => 'select',
			'name' => $name,
			'content' => [
				[
					'type' => 'option',
					'label' => 'One',
					'value' => 1,
				],
				[
					'type' => 'optgroup',
					'label' => 'Group',
					'content' =>[
						[
							'type' => 'option',
							'label' => 'A',
							'value' => 'a',
						],
					],
				],
			],
		]];

		$select = $this->builder->generate($config)[0];

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Select',
			$select
		);

		$this->assertEquals(
			$name,
			$select->getName()
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Option',
			$select[0]
		);

		$this->assertEquals(
			1,
			$select[0]->getValue()
		);

		$this->assertEquals(
			'One',
			$select[0]->getLabel()
		);

		$this->assertInstanceOf(
			 'Fuel\Fieldset\Input\Optgroup',
				 $select[1]
		);

		$this->assertEquals(
			'a',
			$select[1][0]->getValue()
		);

		$this->assertEquals(
			'A',
			$select[1][0]->getLabel()
		);
	}

	/**
	 * @covers ::generate
	 * @covers ::generateInput
	 * @group  Fieldset
	 */
	public function testCreatingRadioGroup()
	{
		$config = [[
			'type' => 'radioGroup',
			'name' => 'radiogroup',
			'content' => [
				[
					'type' => 'radio',
					'label' => 'One',
					'value' => 1,
				],
				[
					'type' => 'radio',
					'label' => 'Two',
					'value' => 2,
				],
			],
		]];

		$group = $this->builder->generate($config)[0];

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\RadioGroup',
			$group
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Radio',
				$group[0]
		);

		$this->assertEquals(
			1,
			$group[0]->getValue()
		);

		$this->assertEquals(
			'One',
			$group[0]->getLabel()
		);
	}

	/**
	 * @covers ::generate
	 * @group  Fieldset
	 */
	public function testGenerateForm()
	{
		$config = [
			[
				'type' => 'form',
			],
		];

		$form = $this->builder->generate($config)[0];

		$this->assertInstanceOf(
			'Fuel\Fieldset\Form',
			$form
		);
	}

}
