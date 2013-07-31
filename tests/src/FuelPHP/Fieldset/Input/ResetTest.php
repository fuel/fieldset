<?php

namespace Fuel\Fieldset\Input;

class ResetTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @covers Fuel\Fieldset\Input\Reset::__construct
	 * @group Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'reset', 'name' => '', 'value' => null];
		
		$instance = new Reset();
		
		$this->assertEquals($attributes, $instance->getAttributes());
    }
	
}
