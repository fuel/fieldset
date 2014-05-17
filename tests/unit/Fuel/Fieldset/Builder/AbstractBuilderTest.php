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
 * Tests for the abstract builder class.
 *
 * @coversDefaultClass \Fuel\Fieldset\Builder\AbstractBuilder
 */
class AbstractBuilderTest extends Test
{

	/**
	 * @var AbstractBuilder
	 */
	protected $builder;

	public function _before()
	{
		$this->builder = new StubBuilder;
	}

	/**
	 * @covers ::__construct
	 * @covers ::setData
	 * @covers ::getData
	 * @group  Fieldset
	 */
	public function testSettingAndGettingData()
	{
		$this->assertEquals(
			[],
			$this->builder->getData()
		);

		$data = 'my custom data';

		$this->builder->setData($data);

		$this->assertEquals(
			$data,
			$this->builder->getData()
		);

		$newBuilder = new Basic($data);

		$this->assertEquals(
			$data,
			$newBuilder->getData()
		);
	}

	/**
	 * @covers ::getElementInstance
	 * @group  Fieldset
	 */
	public function testGettingElementInstance()
	{
		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$this->builder->getElementInstance('submit')
		);
	}

	/**
	 * @covers ::registerElement
	 * @covers ::getElementInstance
	 * @group  Fieldset
	 */
	public function testUsingACustomElement()
	{
		$class = 'Fuel\Fieldset\Input\Submit';

		$this->builder->registerElement(
			'foobar',
			$class
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$this->builder->getElementInstance('foobar')
		);
	}
}
