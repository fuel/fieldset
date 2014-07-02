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
 * @coversDefaultClass \Fuel\Fieldset\FormBuilder
 */
class FormBuilderTest extends Test
{

	/**
	 * @var FormBuilder
	 */
	protected $builder;

	protected function _before()
	{
		$this->builder = new FormBuilder();
	}

	/**
	 * @covers ::getElementInstance
	 * @group  Fieldset
	 */
	public function testGetElementInstance()
	{
		$this->assertInstanceOf(
			'\Fuel\Fieldset\Input\Text',
			$this->builder->getElementInstance('text')
		);
	}

	/**
	 * @covers ::getElementInstance
	 * @covers ::addType
	 * @group  Fieldset
	 */
	public function testRegisterCustomType()
	{
		$this->builder->addType('foobar', '\Fuel\Fieldset\Input\Text');

		$this->assertInstanceOf(
			'\Fuel\Fieldset\Input\Text',
			$this->builder->getElementInstance('foobar')
		);
	}

	/**
	 * @covers ::getElementInstance
	 * @covers ::addType
	 * @group  Fieldset
	 */
	public function testOverrideType()
	{
		$this->builder->addType('submit', '\Fuel\Fieldset\Input\Text');

		$this->assertInstanceOf(
			'\Fuel\Fieldset\Input\Text',
			$this->builder->getElementInstance('submit')
		);
	}

}
