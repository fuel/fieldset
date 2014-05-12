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
 * Tests for Checkbox
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\Checkbox
 */
class CheckboxTest extends Test
{

	/**
	 * @var Checkbox
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new Checkbox;
	}

	/**
	 * @covers ::__construct
	 * @group  Fieldset
	 */
	public function testConstruct()
	{
		$attributes = ['type' => 'checkbox', 'name' => '', 'value' => null];

		$instance = new Checkbox();

		$this->assertEquals($attributes, $instance->getAttributes());
	}

	/**
	 * @covers ::isChecked
	 * @group  Fieldset
	 */
	public function testDefaultChecked()
	{
		$this->assertFalse($this->object->isChecked());
	}

	/**
	 * @covers ::isChecked
	 * @covers ::setChecked
	 * @group  Fieldset
	 */
	public function testGetSetChecked()
	{
		$this->object->setChecked(true);

		$this->assertTrue($this->object->isChecked());
	}

	/**
	 * @covers            ::setChecked
	 * @expectedException \InvalidArgumentException
	 * @group             Fieldset
	 */
	public function testSetNonBool()
	{
		$this->object->setChecked('failure');
	}
}
