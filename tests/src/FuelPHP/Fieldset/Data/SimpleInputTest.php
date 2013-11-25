<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Data;

/**
 * Tests for SimpleInput
 *
 * @package Fuel\Fieldset\Data
 * @author  Fuel Development Team
 */
class SimpleInputTest extends \PHPUnit_Framework_TestCase
{

	public function setUp()
	{
		$_POST = [];
		$_GET = [];
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::get
	 * @group  Fieldset
	 */
	public function testGet()
	{
		$_GET['mockdata'] = 'some data';

		$object = new SimpleInput;

		$this->assertEquals('some data', $object->get('mockdata'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::get
	 * @group  Fieldset
	 */
	public function testGetNested()
	{
		$_GET['mockdata'] = ['subkey' => 'foobar'];

		$object = new SimpleInput;

		$this->assertEquals('foobar', $object->get('mockdata.subkey'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::get
	 * @group  Fieldset
	 */
	public function testGetAll()
	{
		$_GET['mockdata'] = ['subkey' => 'foobar'];

		$object = new SimpleInput;

		$this->assertEquals($_GET, $object->get());
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::post
	 * @group  Fieldset
	 */
	public function testPost()
	{
		$_POST['mockdata'] = 'some data';

		$object = new SimpleInput;

		$this->assertEquals('some data', $object->post('mockdata'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::post
	 * @group  Fieldset
	 */
	public function testPostNested()
	{
		$_POST['mockdata'] = ['subkey' => 'foobar'];

		$object = new SimpleInput;

		$this->assertEquals('foobar', $object->post('mockdata.subkey'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::post
	 * @group  Fieldset
	 */
	public function testPostAll()
	{
		$_POST['mockdata'] = ['subkey' => 'foobar'];

		$object = new SimpleInput;

		$this->assertEquals($_POST, $object->post());
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::input
	 * $group  Fieldset
	 */
	public function testSimpleInput()
	{
		$_POST['mockdata'] = 'foobar';

		$object = new SimpleInput;

		$this->assertEquals('foobar', $object->input('mockdata'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::input
	 * @group  Fieldset
	 */
	public function testSimpleInputNested()
	{
		$_POST['mockdata'] = ['subkey' => 'foobar'];

		$object = new SimpleInput;

		$this->assertEquals('foobar', $object->input('mockdata.subkey'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::input
	 * @group  Fieldset
	 */
	public function testSimpleInputAll()
	{
		$_POST['mockdata'] = ['one' => 'first value', 'three' => 'overridden'];
		$_GET['mockdata'] = ['two' => 'second value', 'three' => 'third value'];

		$object = new SimpleInput;

		$expected = [
			'mockdata' => [
				'one' => 'first value',
				'two' => 'second value',
				'three' => 'overridden',
			]
		];

		$this->assertEquals($expected, $object->input());
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::__construct
	 * @covers Fuel\Fieldset\Data\SimpleInput::config
	 * @group Fieldset
	 */
	public function testConfig()
	{
		$object = new SimpleInput(['testconfig' => 'foobar']);

		$this->assertEquals('foobar', $object->config('testconfig'));
	}

	/**
	 * @covers Fuel\Fieldset\Data\SimpleInput::__construct
	 * @covers Fuel\Fieldset\Data\SimpleInput::config
	 * @group Fieldset
	 */
	public function testConfigAll()
	{
		$config = [
			'foo' => 'bar',
			'baz' => 'bat',
		];

		$object = new SimpleInput($config);

		$this->assertEquals($config, $object->config());
	}

}
