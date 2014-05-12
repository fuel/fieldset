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

/**
 * Tests for ToggleGroup
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @covers  Fuel\Fieldset\Input\ToggleGroup
 */
class ToggleGroupTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var ToggleGroup
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = \Mockery::mock('Fuel\Fieldset\Input\ToggleGroup[setValue,render]');
	}

	/**
	 * @coversDefaultClass setName
	 * @coversDefaultClass getName
	 * @coversDefaultClass isAutoArray
	 * @coversDefaultClass setAutoArray
	 * @group              Fieldset
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
	 * @coversDefaultClass setName
	 * @coversDefaultClass getName
	 * @coversDefaultClass setAutoArray
	 * @coversDefaultClass isAutoArray
	 * @group              Fieldset
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
	 * @coversDefaultClass setAutoArray
	 * @expectedException  \InvalidArgumentException
	 * @group              Fieldset
	 */
	public function testInvalidAutoArray()
	{
		$this->object->setAutoArray('foobar');
	}

	/**
	 * @coversDefaultClass set
	 * @group              Fieldset
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
	 * @coversDefaultClass set
	 * @expectedException  \InvalidArgumentException
	 * @group              Fieldset
	 */
	public function testSetInvalid()
	{
		$item = 'Failure!';
		$this->object[] = $item;
	}

	/**
	 * @coversDefaultClass getName
	 * @coversDefaultClass isAutoArray
	 * @group              Fieldset
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
