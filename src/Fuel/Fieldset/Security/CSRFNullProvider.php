<?php


namespace Fuel\Fieldset\Security;


use Fuel\Fieldset\InputContainer;

class CSRFNullProvider extends CSRFProvider
{


	/**
	 * Gets called before the form is rendered to allow for CSRF injection
	 *
	 * @param InputContainer $form
	 */
	public function insertTokenPreRender(InputContainer $form)
	{
		// Do nothing
	}

	/**
	 * Gets called after the form has been rendered to allow for csrf injection
	 *
	 * @param $formHtml
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
	 */
	public function validateToken(InputContainer $form, $data)
	{
		// Always pass
		return true;
	}
}
