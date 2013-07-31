<?php

namespace Fuel\Fieldset\Input;

class EmailTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @covers Fuel\Fieldset\Input\Email::__construct
	 * @group Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'email', 'name' => '', 'value' => null];
		
		$instance = new Email();
		
		$this->assertEquals($attributes, $instance->getAttributes());
    }
	
}
