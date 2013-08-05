<?php

namespace Fuel\Fieldset\Input;

class HiddenTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @covers Fuel\Fieldset\Input\Hidden::__construct
	 * @group  Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'hidden', 'name' => '', 'value' => null];
		
		$instance = new Hidden();
		
		$this->assertEquals($attributes, $instance->getAttributes());
    }
	
}
