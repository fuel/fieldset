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

use Codeception\TestCase\Test;

/**
 * Tests for Button
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\Button
 */
class ButtonTest extends Test
{

	/**
	 * @covers ::__construct
	 * @group  Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['type' => 'button', 'name' => '', 'value' => null];

		$instance = new Button();

		$this->assertEquals($attributes, $instance->getAttributes());
    }

}
