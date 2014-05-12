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

use Codeception\TestCase\Test;

/**
 * Tests for ToggleGroup
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\ToggleGroup
 */
class ToggleGroupTest extends Test
{

	/**
	 * @var ToggleGroup
	 */
	protected $object;

	protected function _before()
	{
		$this->object = \Mockery::mock('Fuel\Fieldset\Input\ToggleGroup[setValue,render]');
	}

	/**
	 * @covers ::setName
	 * @covers ::getName
	 * @covers ::isAutoArray
	 * @covers ::setAutoArray
	 * @group  Fieldset
	 */
	public function testGetNameAuto()
	{
		$name = 'test';
		$this->object->setAutoArray(true);
		$this->object->setName($name);

		$this->assertEquals(
			$name.'[]',
			$this->object->getName()
		);

		$name2 = 'green[]';
		$this->object->setName($name2);
		$this->assertEquals(
			$name2,
			$this->object->getName()
		);
	}

	/**
	 * @covers ::setName
	 * @covers ::getName
	 * @covers ::setAutoArray
	 * @covers ::isAutoArray
	 * @group  Fieldset
	 */
	public function testGetNameNoAuto()
	{
		$name = 'purple';
		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getName()
		);
	}

	/**
	 * @covers            ::setAutoArray
	 * @expectedException \InvalidArgumentException
	 * @group             Fieldset
	 */
	public function testInvalidAutoArray()
	{
		$this->object->setAutoArray('foobar');
	}

	/**
	 * @covers ::set
	 * @group  Fieldset
	 */
	public function testSet()
	{
		$item = new Checkbox();
		$this->object[] = $item;

		$this->assertEquals(
			[$item],
			$this->object->getContents()
		);
	}

	/**
	 * @covers             ::set
	 * @expectedException  \InvalidArgumentException
	 * @group              Fieldset
	 */
	public function testSetInvalid()
	{
		$item = 'Failure!';
		$this->object[] = $item;
	}

	/**
	 * @covers ::getName
	 * @covers ::isAutoArray
	 * @group  Fieldset
	 */
	public function testChildNameSet()
	{
		$child = new Checkbox();
		$name = 'test[]';
		$this->object[] = $child;
		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$child->getName()
		);
	}

}
