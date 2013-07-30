<?php


namespace Fuel\Fieldset\Input;


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

}
