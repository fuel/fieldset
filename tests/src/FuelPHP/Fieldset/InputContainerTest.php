<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset;

/**
 * Tests for InputContainer
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 */
class InputContainerTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var InputContainer
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = \Mockery::mock('Fuel\Fieldset\InputContainer[render]');
		$_POST = [];
	}

	/**
	 * @covers Fuel\Fieldset\InputContainer::repopulate
	 * @covers Fuel\Fieldset\InputContainer::populate
	 * @covers Fuel\Fieldset\InputContainer::inputNameToKey
	 * @group  Fieldset
	 */
	public function testRepopulate()
	{
		$name = 'name';
		$input = new Input\Text($name);
		$this->object[] = $input;

		$value = 'foobar';

		$_POST[$name] = $value;

		$this->object->repopulate();

		// Remove the following lines when you implement this test.
		$this->assertEquals($value, $input->getValue());
	}

	/**
	 * @covers Fuel\Fieldset\InputContainer::repopulate
	 * @covers Fuel\Fieldset\InputContainer::populate
	 * @covers Fuel\Fieldset\InputContainer::inputNameToKey
	 * @group  Fieldset
	 */
	public function testRepopulateArray()
	{
		$name = 'name[nested]';
		$input = new Input\Text($name);
		$this->object[] = $input;

		$value = 'foobar';

		$data = ['name' => ['nested' => $value]];

		$_POST = $data;

		$this->object->repopulate();

		// Remove the following lines when you implement this test.
		$this->assertEquals($value, $input->getValue());
	}

}
