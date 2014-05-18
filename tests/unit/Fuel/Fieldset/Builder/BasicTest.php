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
			'attributes' => [
				'value' => $value
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
			],
			$submit->getAttributes()
		);
	}

	/**
	 * @covers ::generateForm
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
	}

	/**
	 * @covers ::generateFieldset
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
	}

}
