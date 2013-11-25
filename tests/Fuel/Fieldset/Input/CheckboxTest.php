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
 * Tests for Checkbox
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class CheckboxTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
		$this->object = new Checkbox;
    }

	/**
	 * @covers Fuel\Fieldset\Input\CheckBox::__construct
	 * @group Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'checkbox', 'name' => '', 'value' => null];

		$instance = new Checkbox();

		$this->assertEquals($attributes, $instance->getAttributes());
    }

	/**
	 * @covers Fuel\Fieldset\Input\Toggle::isChecked
	 * @group Fieldset
	 */
	public function testDefaultChecked()
	{
		$this->assertFalse($this->object->isChecked());
	}

	/**
	 * @covers Fuel\Fieldset\Input\Toggle::isChecked
	 * @covers Fuel\Fieldset\Input\Toggle::setChecked
	 * @group Fieldset
	 */
	public function testGetSetChecked()
	{
		$this->object->setChecked(true);

		$this->assertTrue($this->object->isChecked());
	}

	/**
	 * @covers Fuel\Fieldset\Input\Toggle::setChecked
	 * @expectedException \InvalidArgumentException
	 * @group Fieldset
	 */
	public function testSetNonBool()
	{
		$this->object->setChecked('failure');
	}
}
