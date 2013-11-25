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

/**
 * Tests for Fieldset
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 * @sovers  Fuel\Fieldset\Fieldset
 */
class FieldsetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Fieldset
     */
    protected $object;

	protected $testFileLocations;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Fieldset;

		$this->testFileLocations = array(
			'testRender' => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'FieldsetTest_testRender.xml',
			'testRenderWithLegend' => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'FieldsetTest_testRenderWithLegend.xml',
			'testRenderWithElement' => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'FieldsetTest_testRenderWithElement.xml',
		);
    }

	/**
	 * @coversDefaultClass setLegend
	 * @coversDefaultClass getLegend
	 * @group              Fieldset
	 */
	public function testSetGetLegend()
	{
		$legend = 'This is a legend';

		$this->object->setLegend($legend);

		$this->assertEquals(
			$legend,
			$this->object->getLegend()
		);
	}

	/**
	 * @coversDefaultClass render
	 * @group              Fieldset
	 */
	public function testRender()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$this->assertXmlStringEqualsXmlFile(
			$this->testFileLocations['testRender'],
			$this->object->render($renderer)
		);
	}

	/**
	 * @coversDefaultClass render
	 * @group              Fieldset
	 */
	public function testRenderWithLegend()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$this->object->setLegend('Test Legend');

		$this->assertXmlStringEqualsXmlFile(
			$this->testFileLocations['testRenderWithLegend'],
			$this->object->render($renderer)
		);
	}

	/**
	 * @coversDefaultClass render
	 * @group              Fieldset
	 */
	public function testRenderWithElement()
	{
		$renderer = \Mockery::mock('Fuel\Fieldset\Render');

		$input = \Mockery::mock('Fuel\Fieldset\InputElement');

		$renderer->shouldReceive('render')->with($input)->once()->andReturn('<input/>');

		$this->object[] = $input;

		$this->assertXmlStringEqualsXmlFile(
			$this->testFileLocations['testRenderWithElement'],
			$this->object->render($renderer)
		);
	}

}
