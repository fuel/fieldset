<?php
/**
 * @package   Fuel\Fieldset\Builder
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2014 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Builder;

use Codeception\TestCase\Test;

/**
 * Tests for the abstract builder class.
 *
 * @coversDefaultClass \Fuel\Fieldset\Builder\AbstractBuilder
 */
class AbstractBuilderTest extends Test
{

	/**
	 * @var AbstractBuilder
	 */
	protected $builder;

	public function _before()
	{
		$this->builder = new StubBuilder;
	}

	/**
	 * @covers ::getElementInstance
	 * @group  Fieldset
	 */
	public function testGettingElementInstance()
	{
		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$this->builder->getElementInstance('submit')
		);
	}

	/**
	 * @covers ::registerElement
	 * @covers ::getElementInstance
	 * @group  Fieldset
	 */
	public function testUsingACustomElement()
	{
		$class = 'Fuel\Fieldset\Input\Submit';

		$this->builder->registerElement(
			'foobar',
			$class
		);

		$this->assertInstanceOf(
			'Fuel\Fieldset\Input\Submit',
			$this->builder->getElementInstance('foobar')
		);
	}
}
