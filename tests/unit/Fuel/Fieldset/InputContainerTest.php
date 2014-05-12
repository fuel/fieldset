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

use Codeception\TestCase\Test;

/**
 * Tests for InputContainer
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 *
 * @coversDefaultClass Fuel\Fieldset\InputContainer
 */
class InputContainerTest extends Test
{

	/**
	 * @var InputContainer
	 */
	protected $object;

	protected function _before()
	{
		$this->object = \Mockery::mock('Fuel\Fieldset\InputContainer[render]');
		$_POST = [];
	}

	/**
	 * @covers ::repopulate
	 * @covers ::populate
	 * @covers ::inputNameToKey
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
	 * @covers ::repopulate
	 * @covers ::populate
	 * @covers ::inputNameToKey
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
	 * @covers ::populate
	 * @group  Fieldset
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
