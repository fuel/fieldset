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
 * Tests for RadioGroup
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class RadioGroupTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var RadioGroup
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new RadioGroup();
	}

	/**
	 * @covers Fuel\Fieldset\Input\RadioGroup::set
	 * @group  Fieldset
	 */
	public function testAddRadio()
	{
		$radio = new Radio();
		$this->object[] = $radio;

		$this->assertEquals(
			[$radio],
			$this->object->getContents()
		);
	}

	/**
	 * @covers Fuel\Fieldset\Input\RadioGroup::set
	 * @group             Fieldset
	 * @expectedException \InvalidArgumentException
	 */
	public function testAddNonRadio()
	{
		$radio = 'fake';
		$this->object[] = $radio;
	}

	/**
	 * @covers Fuel\Fieldset\Input\RadioGroup::set
	 * @covers Fuel\Fieldset\Input\RadioGroup::setValue
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$radio1 = new Radio('one', [], 'test');
		$radio2 = new Radio('two', [], 'second');

		$this->object[] = $radio1;
		$this->object[] = $radio2;

		$this->object->setValue('test');

		$this->assertEquals(
			true,
			$radio1->isChecked()
		);
		$this->assertEquals(
			false,
			$radio2->isChecked()
		);

		$this->object->setValue('second');

		$this->assertEquals(
			false,
			$radio1->isChecked()
		);
		$this->assertEquals(
			true,
			$radio2->isChecked()
		);
	}

	/**
	 * @covers            Fuel\Fieldset\Input\RadioGroup::setValue
	 * @group             Fieldset
	 * @expectedException \InvalidArgumentException
	 */
	public function testInvalidValue()
	{
		$this->object->setValue(new Radio());
	}

	public function testFromArray()
	{
		$config = [
			'name' => 'test',
			'_content' => [
				'1' => 'one',
				'2' => 'two',
			]
		];

		$object = RadioGroup::fromArray($config);

		// Check we have the right object
		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\RadioGroup',
			$object
		);

		// Check we have the correct name
		$this->assertEquals(
			'test',
			$object->getName()
		);

		// Check we have the right content
		foreach ($object->getContents() as $radio)
		{
			$this->assertInstanceOf(
				'Fuel\Fieldset\Input\Radio',
				$radio
			);
		}
	}

	/**
	 * @coversDefaultClass render
	 * @group              Fieldset
	 */
	public function testRender()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$radio1 = \Mockery::mock('Fuel\Fieldset\Input\Radio');
		$radio2 = \Mockery::mock('Fuel\Fieldset\Input\Radio');

		$renderer->shouldReceive('render')->with($radio1)->once()->andReturn('<input type="radio" name=""/>');
		$renderer->shouldReceive('render')->with($radio2)->once()->andReturn('<input type="radio" name=""/>');

		$this->object[] = $radio1;
		$this->object[] = $radio2;

		$this->assertEquals(
			'<input type="radio" name=""/><input type="radio" name=""/>',
			$this->object->render($renderer)
		);
	}

}
