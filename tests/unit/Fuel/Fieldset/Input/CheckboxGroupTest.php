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
 * Tests for CheckboxGroup
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\CheckboxGroup
 */
class CheckboxGroupTest extends Test
{

	/**
	 * @var CheckboxGroup
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new CheckboxGroup;
	}

	/**
	 * @covers ::set
	 * @group  Fieldset
	 */
	public function testAddCheckbox()
	{
		$checkbox = new Checkbox();
		$this->object[] = $checkbox;

		$this->assertEquals(
			[$checkbox],
			$this->object->getContents()
		);
	}

	/**
	 * @covers            ::set
	 * @expectedException \InvalidArgumentException
	 * @group             Fieldset
	 */
	public function testAddInvalid()
	{
		$this->object[] = 'Fluebar';
	}

	/**
	 * @covers ::setName
	 * @group  Fieldset
	 */
	public function testSetName()
	{
		$checkbox1 = new Checkbox();
		$checkbox2 = new Checkbox();

		$this->object[] = $checkbox1;
		$this->object[] = $checkbox2;

		$name = 'test';

		$this->object->setName($name);

		$this->assertEquals(
			$checkbox1->getName(),
			$name . '[]'
		);

		$this->assertEquals(
			$checkbox2->getName(),
			$name . '[]'
		);
	}

	/**
	 * @covers ::setValue
	 * @covers ::getValue
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$checkbox1 = new Checkbox('', [], '1');
		$checkbox2 = new Checkbox('', [], '2');

		$this->object[] = $checkbox1;
		$this->object[] = $checkbox2;

		$this->object->setValue(1);

		$this->assertEquals(
			1,
			$this->object->getValue()
		);

		$this->assertTrue($checkbox1->isChecked());
		$this->assertFalse($checkbox2->isChecked());

		$this->object->setValue([1, 2]);

		$this->assertTrue($checkbox1->isChecked());
		$this->assertTrue($checkbox2->isChecked());

		$this->object->setValue([]);

		$this->assertFalse($checkbox1->isChecked());
		$this->assertFalse($checkbox2->isChecked());
	}

}
