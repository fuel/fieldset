<?php

/**
 * Alias the Fieldset namespace to global so we can overload the Fieldset class
 */
Autoloader::add_core_namespace('Fieldset');

/**
 * Inform the autoloader where to find what...
 */

/**
 * v1.x style classes.
 */
Autoloader::add_classes(array(
	'Fieldset\\Fieldset'					=> __DIR__.'/classes/fieldset.php',
));

/**
 * v2.0 style classes. They are PSR-0, so we only need to define the path.
 */
Autoloader::add_namespace('Fuel\\Fieldset', __DIR__.'/src/Fuel/Fieldset/', true);
