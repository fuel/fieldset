<?php


namespace Fuel\Fieldset;


class FormFactoryTest extends \PHPUnit_Framework_TestCase
{

	protected function setUp()
	{

	}

	public function testFromArray()
	{
		$config = [
			'Form' => [
				'action' => '',
				'method' => 'POST',
				'_content' => [
					// Initial name input
					'Text' => [
						'name' => 'name',
					],
					// Create a fieldset for account stuff
					'Fieldset' => [
						'legend' => 'account',
						'_content' => [
							// Add an email field
							'Email' => [
								'name' => 'email',
							],
							'Select' => [
								'name' => 'sex',
								'_content' => [
									'u' => 'Unknown',
									'f' => 'Female',
									'm' => 'Male',
								],
							],
							// Keep me updated checkbox
							'Checkbox' => [
								'name' => 'keep_updated',
							],
						],
					],
					'Submit' => [
						'value' => 'Create Account',
					],
				]
			],
		];
	}

}
