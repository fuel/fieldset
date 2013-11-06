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
 * Tests for Optgroup
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class OptgroupTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
		$this->object = new Optgroup;
    }

	/**
	 * @covers Fuel\Fieldset\Input\Optgroup::set
	 * @group  Fieldset
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
	 * @covers            Fuel\Fieldset\Input\Optgroup::set
	 * @group             Fieldset
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetInvalid()
	{
		$this->object[] = '';
	}

	public function testFromArray()
	{
		$config = [
			'label' => 'test',
			'_content' => [
				'1' => 'One',
				'2' => 'Two',
			]
		];

		$object = Optgroup::fromArray($config);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Optgroup',
			$object
		);

		$this->assertEquals(
			'test',
			$object->getAttributes()['label']
		);

		// Check the right content has been set
		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Option',
			$object[0]
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Option',
			$object[1]
		);
	}

}
