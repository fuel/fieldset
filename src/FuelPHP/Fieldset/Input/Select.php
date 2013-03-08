<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   FuelPHP\Fieldset\Input
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace FuelPHP\Fieldset\Input;

use FuelPHP\Common\DataContainer;
use FuelPHP\Fieldset\Render\Renderable;
use FuelPHP\Common\Arr;
use FuelPHP\Fieldset\Input\Select\Optgroup;
use FuelPHP\Fieldset\Input\Select\Option;

/**
 * 
 *
 * @package FuelPHP\Fieldset\Input
 * @since   2.0.0
 * @author  Fuel Development Team
 */
class Select extends DataContainer implements Renderable
{

	protected $name = null;
	protected $value = null;
	
	/**
	 * Override the DataContainer's set function to enable type checking.
	 * 
	 * @param string $key
	 * @param Select\Option|Select\Optgroup $value
	 * @throws \InvalidArgumentException
	 */
	public function set($key, $value)
	{
		if ( !($value instanceof Option) &&
			!($value instanceof Optgroup) )
		{
			throw new \InvalidArgumentException('Only Options or Optgroups can be added to a Select.');
		}

		return parent::set($key, $value);
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setValue($name)
	{
		$this->name = $name;
		return $this;
	}
	
	public function getValue()
	{
		return $this->name;
	}
	
	//TODO: Use traits for this when able

	protected $_attributes = array();

	/**
	 * Sets the attributes for the Input
	 * 
	 * @param array $attributes
	 * @return \FuelPHP\Fieldset\Input
	 */
	public function setAttributes(array $attributes)
	{
		$this->_attributes = Arr::merge($this->_attributes, $attributes);
		return $this;
	}

	/**
	 * Gets the attributes for the Input
	 * 
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->_attributes;
	}

}
