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
 * Common interface for classes that provide CSRF functionality for a fieldset
 *
 * @package Fuel\Fieldset\Security
 * @author  Fuel Development Team
 */
abstract class CSRFProvider
{

	/**
	 * Gets called before the form is rendered to allow for CSRF injection
	 *
	 * @param InputContainer $form
	 */
	public abstract function insertTokenPreRender(InputContainer $form);

	/**
	 * Gets called after the form has been rendered to allow for csrf injection
	 *
	 * @param $formHtml
	 */
	public abstract function insertTokenPostRender(&$formHtml);

	/**
	 * Should return true or false to indicate the status of CSRF validation
	 *
	 * @param InputContainer $form
	 * @param                $data
	 *
	 * @return mixed
	 */
	public abstract function validateToken(InputContainer $form, $data);

}
