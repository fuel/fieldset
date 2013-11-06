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
 * Tests for Email
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
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
