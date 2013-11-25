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
 * Tests for Option
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @covers  Fuel\Fieldset\Input\Option
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Option
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Option;
	}

	/**
	 * @coversDefaultClass render
	 * @group              Fieldset
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
