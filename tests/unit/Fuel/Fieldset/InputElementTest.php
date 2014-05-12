<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset;

use Codeception\TestCase\Test;

/**
 * Tests for InputElement
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 *
 * @coversDefaultClass \Fuel\Fieldset\InputElement
 */
class InputElementTest extends Test
{
	/**
	 * @var InputElement
	 */
	protected $object;

	protected function _before()
	{
		$this->object = new InputElement('');
	}

	/**
	 * @covers ::setName
	 * @group  Fieldset
	 */
	public function testSetName()
	{
		$this->object->setName('test-name');
		$this->assertEquals('test-name', $this->object->getName());
	}

	/**
	 * @covers ::getName
	 * @group  Fieldset
	 */
	public function testGetName()
	{
		$this->assertEquals('', $this->object->getName());
	}

	/**
	 * @covers ::getValue
	 * @group  Fieldset
	 */
	public function testGetValue()
	{
		$this->assertNull($this->object->getValue());
	}

	/**
	 * @covers ::setValue
	 * @group  Fieldset
	 */
	public function testSetValue()
	{
		$this->object->setValue('test-value');
		$this->assertEquals('test-value', $this->object->getValue());
	}

	/**
	 * @covers            ::setName
	 * @expectedException \InvalidArgumentException
	 * @group             Fieldset
	 */
	public function testInvalidName()
	{
		$this->object->setName(new InputElement);
	}

	/**
	 * @covers ::setAttributes
	 * @covers ::getAttributes
	 * @group  Fieldset
	 */
	public function testGetSetAttributes()
	{
		$attributes = ['name' => 'foobar', 'value' => null];

		$this->object->setAttributes($attributes);

		$this->assertEquals($attributes, $this->object->getAttributes());
	}

	/**
	 * @covers ::__construct
	 * @group  Fieldset
	 */
	public function testConstructor()
	{
		$name = 'foorbar';
		$value = '12345';
		$attributes = ['id' => 'input-foobar', 'value' => $value];

		$input = new InputElement($name, $attributes, $value);

		$this->assertEquals($name, $input->getName());
		$this->assertEquals($attributes + ['name' => $name], $input->getAttributes());
		$this->assertEquals($value, $input->getValue());
	}

	/**
	 * @covers ::getAttribute
	 * @covers ::setAttribute
	 * @group  Fieldset
	 */
	public function testIndividualAttribute()
	{
		$name = 'random_attr';
		$value = '1234567890';

		$this->object->setAttribute($name, $value);

		$this->assertEquals(
			 $value,
				 $this->object->getAttribute($name)
		);

		// Check the correct default gets returned
		$expectedDefault = 'foobar';

		$this->assertEquals(
			 $expectedDefault,
				 $this->object->getAttribute('This does not exist!', $expectedDefault)
		);
	}

	/**
	 * @covers ::getAttributes
	 * @covers ::setAttribute
	 * @group  Fieldset
	 */
	public function testAttributeArray()
	{
		$attributes = [
			'value' => 'pink',
			'name' => 'input_area',
		];

		$this->object->setAttribute($attributes);

		$this->assertEquals(
			 $attributes,
				 $this->object->getAttributes()
		);
	}

	/**
	 * @covers ::getLabel
	 * @covers ::setLabel
	 * @group  Fieldset
	 */
	public function testGetSetLabel()
	{
		$name = 'rob';

		$this->object->setName($name);

		// Check the correct default is returned
		$this->assertEquals(
			 $name,
				 $this->object->getLabel()
		);

		// Check the correct value is returned when a label is set
		$label = 'What is your name?';

		$this->object->setLabel($label);

		$this->assertEquals(
			 $label,
				 $this->object->getLabel()
		);
	}

	/**
	 * @covers ::getMeta
	 * @covers ::setMeta
	 * @group  Fieldset
	 */
	public function testGetSetMeta()
	{
		$key = 'foobar';
		$value = 'bazbat';

		$this->object->setMeta($key, $value);

		$this->assertEquals(
			 $value,
				 $this->object->getMeta($key)
		);

		$default = 'test';
		$this->assertEquals(
			 $default,
				 $this->object->getMeta('empty', $default)
		);
	}

	/**
	 * @covers ::render
	 * @group  Fieldset
	 */
	public function testRender()
	{
		$render = \Mockery::mock('Fuel\Fieldset\Render');

		$render1 = $this->object->render($render);
		$this->assertXmlStringEqualsXmlString(
			 '<input name="" value=""/>',
				 $render1
		);
	}

}
