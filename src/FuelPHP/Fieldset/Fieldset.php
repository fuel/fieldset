<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset;

use IteratorAggregate;
use ArrayAccess;
use Countable;

/**
 * Allows for the programtic construction of html forms.
 * 
 * @package FuelPHP\Fieldset
 * @since   2.0.0
 * @author  Steve "uru" West <uruwolf@gmail.com>
 */
class Fieldset implements
	IteratorAggregate,
	ArrayAccess,
	Countable
{
	
	/**
	 * @var array
	 */
	protected $_elements = array();
	
	public function add(Input $element)
	{
		
	}
	
	public function getIterator()
	{
        return new ArrayIterator($this);
    }

	public function count()
	{
		return count($this->_elements);
	}

	public function offsetExists($offset)
	{
		
	}

	public function offsetGet($offset)
	{
		
	}

	public function offsetSet($offset, $value)
	{
		
	}

	public function offsetUnset($offset)
	{
		
	}
	
}
