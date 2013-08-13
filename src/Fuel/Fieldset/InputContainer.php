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

use Fuel\Common\DataContainer;
use Fuel\Common\Arr;
use Fuel\Common\Str;
use Fuel\Fieldset\Render\Renderable;
use Fuel\Fieldset\Data\Input;

/**
 * Defines a common interface for objects that can handle input data
 * 
 * @package Fuel\Fieldset
 * @since   2.0.0
 * @author  Fuel Development Team
 */
abstract class InputContainer extends DataContainer implements Renderable
{
	use InputTrait;

	/**
	 * Repopulates the fields using input data. By default uses a combination
	 * of get and post but other data can be used by passing a child of Input
	 * 
	 * @param \Fuel\Fieldset\Data\Input $data
	 */
	public function repopulate(Input $data = null)
	{
		if ( is_null($data) )
		{
			$data = new Input;
		}

		$this->populate($data->input());
		
		return $this;
	}

	/**
	 * Populates the fields using the array passed.
	 * 
	 * @param array $data The data to use for population.
	 * @return \Fuel\Fieldset\InputContainer
	 */
	public function populate($data)
	{
		// Loop through all the elements assigned and attempt to assign a value to them.
		foreach ( $this->getContents() as $item )
		{
			if ($item instanceof InputContainer)
			{
				// This is another Fieldset or Form so needs to be populated too
				$item->populate($data);
			}
			// This is a regular input so it can be populated
			else
			{
				// Convert the name to a dot notation for better searching
				$key = $this->inputNameToKey($item->getName());
				$value = Arr::get($data, $key);

				if ( !is_null($value) )
				{
					$item->setValue($value);
				}
			}
		}
		
		return $this;
	}

	/**
	 * Helper function to convert html array'd input names into dot notation for
	 * easy access.
	 * 
	 * @param string $name
	 * @return string
	 */
	public function inputNameToKey($name)
	{
		$key = str_replace(['[', ']'], ['.', ''], $name);
		
		return trim($key, '.');
	}

	/**
	 * Takes an array and returns a populated instance of this input container. Child objects should override this to
	 * provide correct population functionality.
	 *
	 * @param array $config
	 *
	 * @return static
	 */
	public static function fromArray($config = [])
	{
		$instance = new static();

		// Get any content
		$content = Arr::get($config, '_content', array());

		// Make sure the content is not confused for other attributes
		Arr::delete($config, '_content');

		// Set any needed attributes
		$instance->setAttributes($config);

		// Build any content that we might need
		$processedContent = FormFactory::fromArray($content);

		// Check if more than one element has been returned
		if (is_array($processedContent))
		{
			// If so then set our content
			$instance->setContents($processedContent);
		}
		else
		{
			// If juts one then add it normally
			$instance[] = $processedContent;
		}

		return $instance;
	}

}
