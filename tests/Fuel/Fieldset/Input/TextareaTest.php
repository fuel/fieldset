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
 * Tests for Textarea
 *
 * @package Fuel\Fieldset\Input
 * @author  Fuel Development Team
 * @covers  Fuel\Fieldset\Input\Textarea
 */
class TextareaTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var Textarea
	 */
	protected $object;

	protected function setUp()
	{
		$this->object = new Textarea();
	}

	/**
	 * @coversDefaultClass __construct
	 * @group              Fieldset
     */
    public function testConstruct()
    {
		$attributes = ['name' => '', 'value' => null];

		$instance = new Textarea();

		$this->assertEquals($attributes, $instance->getAttributes());
    }

	/**
	 * @coversDefaultClass setValue
	 * @coversDefaultClass getContent
	 * @group              Fieldset
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
			$this->object->getContent()
		);
	}

	/**
	 * @coversDefaultClass render
	 * @covers             Fuel\Fieldset\Element::setContent
	 * @covers             Fuel\Fieldset\Element::getContent
	 * @group              Fieldset
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
