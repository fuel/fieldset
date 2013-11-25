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
 * Tests for Select
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class SelectTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Select
	 */
	protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		$this->object = new Select;
    }

	/**
	 * @covers Fuel\Fieldset\Input\Select::set
	 * @group Fieldset
     */
    public function testSet()
    {
		$this->object[] = new Option;
		$this->object[] = new Option;
		$this->object[] = new Option;
		$this->object[] = new Option;

		$this->assertEquals(4, count($this->object));
    }

	/**
	 * @expectedException \InvalidArgumentException
	 * @covers Fuel\Fieldset\Input\Select::set
	 * @group Fieldset
	 */
	public function testSetInvalid()
	{
		$this->object[] = '';
	}

	/**
	 * @covers Fuel\Fieldset\Input\Select::set
	 * @group Fieldset
	 */
	public function testSetOptgroup()
	{
		$this->object[] = new Optgroup;

		$this->assertEquals(1, count($this->object));
	}

	/**
	 * @group Fieldset
	 */
	public function testSetValue()
	{
		$option = new  Option('test');
		$this->object[] = $option;
		$this->object->setValue('test');

		$this->assertEquals(
			['selected', 'value' => 'test'],
			$option->getAttributes()
		);
	}

	public function testFromArray()
	{
		$config = [
			'name' => 'foobar',
			'_content' => [
				'optgroup' => [
					'a' => 'array',
					'b' => 'binary',
				],
				'1' => 'one',
				'2' => 'two',
			],
		];

		$object = Select::fromArray($config);

		// Got the right object?
		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Select',
			$object
		);

		// With the right name?
		$this->assertEquals(
			'foobar',
			$object->getName()
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Optgroup',
			$object[0]
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Option',
			$object[1]
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Option',
			$object[2]
		);
	}
}
