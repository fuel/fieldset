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
 * Tests for Textarea
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\Input\Textarea
 */
class TextareaTest extends Test
{

	/**
	 * @var Textarea
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new Textarea();
	}

	/**
	 * @covers ::__construct
	 * @group  Fieldset
	 */
	public function testConstruct()
	{
		$attributes = ['name' => '', 'value' => null];

		$instance = new Textarea();

		$this->assertEquals($attributes, $instance->getAttributes());
    }

	/**
	 * @covers ::setValue
	 * @covers ::getContents
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$value = 'green eggs and ham';

		$this->object->setValue($value);

		$this->assertEquals(
			$value,
			$this->object->getValue()
		);

		$this->assertEquals(
			$value,
			$this->object->getContents()
		);
	}

	/**
	 * @covers ::render
	 * @covers Fuel\Fieldset\Element::setContent
	 * @covers Fuel\Fieldset\Element::getContents
	 * @group  Fieldset
	 */
	public function testRender()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$this->object->setContent('abc');

		$this->assertXmlStringEqualsXmlString(
			'<textarea name="" value="">abc</textarea>',
			$this->object->render($renderer)
		);
	}

}
