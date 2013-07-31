<?php

/**
 * Part of the FuelPHP framework.
 *
 * @package   Fuel\Fieldset
 * @version   2.0
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 */

namespace Fuel\Fieldset;

use Fuel\Common\Arr;

/**
 *
 *
 * @package Fuel\Fieldset
 * @author  Fuel Development Team
 */
class FormFactory
{

	private static $instance = null;

	protected function __construct()
	{
		// Do nothing
	}

	/**
	 * Returns a working instance for the FormFactory
	 *
	 * @return FormFactory
	 */
	public static function instance()
	{
		if (is_null(static::$instance))
		{
			static::$instance = new static;
		}

		return static::$instance;
	}

	public static function fromArray($config)
	{
		$return = [];

		foreach ($config as $class => $itemConfig)
		{
			$fullClassName = 'Fuel\Fieldset\Input\\'.$class;

			if ( ! class_exists($fullClassName))
			{
				// Try the name on its own to see if the user provided a full namespace
				if ( ! class_exists($fullClassName))
				{
					// User is not using a custom namespace as far as we can tell so try the main namespace for Form and Fieldset
					$fullClassName = 'Fuel\Fieldset\\'.$class;
				}
			}

			$return[] = $fullClassName::fromArray($itemConfig);
		}

		if (count($return) == 0)
		{
			$return = '';
		}
		else if (count($return) == 1)
		{
			$return = $return[0];
		}

		return $return;

	}

}
