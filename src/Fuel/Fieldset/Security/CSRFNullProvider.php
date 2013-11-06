<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset\Security;

use Fuel\Fieldset\InputContainer;

/**
 * Default CSRF provider that does not do anything
 *
 * @package Fuel\Fieldset\Security
 * @author  Fuel Development Team
 * @since   2.0
 */
class CSRFNullProvider extends CSRFProvider
{

	/**
	 * Gets called before the form is rendered to allow for CSRF injection
	 *
	 * @param InputContainer $form
	 *
	 * @since 2.0
	 */
	public function insertTokenPreRender(InputContainer $form)
	{
		// Do nothing
	}

	/**
	 * Gets called after the form has been rendered to allow for csrf injection
	 *
	 * @param $formHtml
	 *
	 * @since 2.0
	 */
	public function insertTokenPostRender(&$formHtml)
	{
		// Do nothing
	}

	/**
	 * Should return true or false to indicate the status of CSRF validation
	 *
	 * @param InputContainer $form
	 * @param                $data
	 *
	 * @return boolean
	 *
	 * @since 2.0
	 */
	public function validateToken(InputContainer $form, $data)
	{
		// Always pass
		return true;
	}
}
