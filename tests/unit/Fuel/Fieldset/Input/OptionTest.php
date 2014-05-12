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
 * Tests for Option
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\Option
 */
class OptionTest extends Test
{

	/**
	 * @var Option
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new Option;
	}

	/**
	 * @covers ::render
	 * @group  Fieldset
	 */
	public function testRender()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$this->assertXmlStringEqualsXmlString(
			'<option value=""></option>',
			$this->object->render($renderer)
		);
	}
}
