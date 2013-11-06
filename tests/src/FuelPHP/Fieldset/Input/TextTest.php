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
 * Tests for Text
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 */
class TextTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

	/**
	 * @covers Fuel\Fieldset\Input\Text::__construct
	 * @group Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'text', 'name' => '', 'value' => null];

		$instance = new Text();

		$this->assertEquals($attributes, $instance->getAttributes());
    }

}
