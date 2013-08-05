<?php

namespace Fuel\Fieldset\Input;

class TextareaTest extends \PHPUnit_Framework_TestCase
{

	protected $object;

	protected function setUp()
	{
		$this->object = new Textarea();
	}

	/**
	 * @covers Fuel\Fieldset\Input\Textarea::__construct
	 * @group  Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['name' => '', 'value' => null];
		
		$instance = new Textarea();
		
		$this->assertEquals($attributes, $instance->getAttributes());
    }

	/**
	 * @covers Fuel\Fieldset\Input\Textarea::setValue
	 * @covers Fuel\Fieldset\Input\Textarea::getContent
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$value = 'green eggs and ham';

		$this->object->setValue($value);

		$this->assertEquals(
			$value,
			$this->object->getValue()
		);

		$this->assertEquals(
			$value,
			$this->object->getContent()
		);
	}
	
}
