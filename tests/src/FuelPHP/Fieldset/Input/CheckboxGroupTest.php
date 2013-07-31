<?php


namespace Fuel\Fieldset\Input;


class CheckboxGroupTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var CheckboxGroup
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new CheckboxGroup;
	}

	/**
	 * @covers Fuel\Fieldset\Input\CheckboxGroup::set
	 * @group  Fieldset
	 */
	public function testAddCheckboxes()
	{
		$checkbox = new Checkbox();
		$this->object[] = $checkbox;

		$this->assertEquals(
			[$checkbox],
			$this->object->getContents()
		);
	}

	/**
	 * @covers            Fuel\Fieldset\Input\CheckboxGroup::set
	 * @group             Fieldset
	 * @expectedException \InvalidArgumentException
	 */
	public function testAddInvalid()
	{
		$this->object[] = 'Fluebar';
	}

	/**
	 * @covers Fuel\Fieldset\Input\CheckboxGroup::setName
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
	 * @covers Fuel\Fieldset\Input\CheckboxGroup::setValue
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$checkbox1 = new Checkbox('', [], '1');
		$checkbox2 = new Checkbox('', [], '2');

		$this->object[] = $checkbox1;
		$this->object[] = $checkbox2;

		$this->object->setValue(1);

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
