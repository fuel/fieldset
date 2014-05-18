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
 * Tests for Select
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\Select
 */
class SelectTest extends Test
{

	/**
	 * @var Select
	 */
	protected $object;

    protected function _before()
    {
		$this->object = new Select;
    }

	/**
	 * @covers ::set
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
	 * @covers            ::set
	 * @expectedException \InvalidArgumentException
	 * @group             Fieldset
	 */
	public function testSetInvalid()
	{
		$this->object[] = '';
	}

	/**
	 * @covers ::set
	 * @group  Fieldset
	 */
	public function testSetOptgroup()
	{
		$this->object[] = new Optgroup;

		$this->assertEquals(1, count($this->object));
	}

	/**
	 * @covers ::setValue
	 * @covers ::getValue
	 * @covers ::getAttributes
	 * @covers ::set
	 * @group  Fieldset
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

		$this->assertEquals(
			'test',
			$this->object->getValue()
		);
	}

	/**
	 * @covers ::fromArray
	 * @group  Fieldset
	 */
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

	/**
	 * @covers ::render
	 * @group  Fieldset
	 */
	public function testRender()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$this->assertXmlStringEqualsXmlString(
			'<select></select>',
			$this->object->render($renderer)
		);
	}

	/**
	 * @covers ::render
	 * @group  Fieldset
	 */
	public function testRenderWithContent()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$option = \Mockery::mock('Fuel\Fieldset\Input\Option');

		$renderer->shouldReceive('render')->with($option)->andReturn('<option></option>')->once();

		$this->object[] = $option;

		$this->assertXmlStringEqualsXmlString(
			'<select><option></option></select>',
			$this->object->render($renderer)
		);
	}

	/**
	 * @covers ::setName
	 * @covers ::getName
	 * @group  Fieldset
	 */
	public function testGetSetName()
	{
		$name = 'name';

		$this->object->setName($name);

		$this->assertEquals(
			$name,
			$this->object->getName()
		);
	}

}
