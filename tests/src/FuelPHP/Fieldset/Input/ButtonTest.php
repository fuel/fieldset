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
 * Tests for Button
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
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
