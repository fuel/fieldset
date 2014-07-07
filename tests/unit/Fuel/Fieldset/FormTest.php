<?php

namespace Fuel\Fieldset;

use Fuel\Fieldset\Render\BasicRender;

class FormTest extends \Codeception\TestCase\Test
{
	/**
	* @var \CodeGuy
	*/
	protected $form;

	protected function _before()
	{
		$this->form = new Form();
	}

	protected function _after()
	{
	}

	public function testGetElement()
	{
		$this->form['input_text1'] = new Input\Text('input_text1');
		$this->form['input_text1']->setLabel('input_text1_label');
		$renderer = new BasicRender();
		$this->form->setRenderer($renderer);
		
		$this->assertEquals('<input value="" name="input_text1" type="text"/>', $this->form->renderElement('input_text1'));
		$this->assertEquals('input_text1_label', $this->form->getElementLabel('input_text1'));
	}

}
