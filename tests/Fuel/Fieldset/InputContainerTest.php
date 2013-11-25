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
 * @covers  Fuel\Fieldset\InputContainer
 */
class InputContainerTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var InputContainer
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = \Mockery::mock('Fuel\Fieldset\InputContainer[render]');
		$_POST = [];
	}

	/**
	 * @coversDefaultClass repopulate
	 * @coversDefaultClass populate
	 * @coversDefaultClass inputNameToKey
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
	 * @coversDefaultClass repopulate
	 * @coversDefaultClass populate
	 * @coversDefaultClass inputNameToKey
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

	/**
	 * @coversDefaultClass populate
	 * @group              Fieldset
	 */
	public function testPopulateChildInputContainer()
	{
		$data = array();

		$child = \Mockery::mock('Fuel\Fieldset\InputContainer');
		$child->shouldReceive('populate')->with($data)->once();

		$this->object->set(0, $child);

		$this->object->populate($data);
	}

	/**
	 * @covers \Fuel\Fieldset\InputTrait::getMetaContainer
	 * @group  Fieldset
	 */
	public function testGetMeta()
	{
		$this->assertEquals(
			[],
			$this->object->getMetaContainer()
		);
	}

}
