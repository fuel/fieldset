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
 */
class FieldsetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Fieldset
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Fieldset;
    }

	/**
	 * @covers Fuel\Fieldset\Fieldset::setLegend
	 * @covers Fuel\Fieldset\Fieldset::getLegend
	 * @group Fieldset
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

}
