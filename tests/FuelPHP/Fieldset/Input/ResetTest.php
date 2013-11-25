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
 * Tests for Reset
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
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
