<?php

namespace Fuel\Fieldset\Input;

class ButtonTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @covers Fuel\Fieldset\Input\Button::__construct
	 * @group Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'button', 'name' => '', 'value' => null];
		
		$instance = new Button();
		
		$this->assertEquals($attributes, $instance->getAttributes());
    }
	
}
