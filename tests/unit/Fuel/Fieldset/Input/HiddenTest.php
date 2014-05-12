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
 * Tests for Hidden
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
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
