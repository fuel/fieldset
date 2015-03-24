# Fuel Fieldset Package

[![Build Status](https://travis-ci.org/fuelphp/fieldset.png?branch=master)](https://travis-ci.org/fuelphp/fieldset)
[![Code Coverage](https://scrutinizer-ci.com/g/fuelphp/fieldset/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/fuelphp/fieldset/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/fuelphp/fieldset/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fuelphp/fieldset/?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/fuelphp/fieldset.svg)](http://hhvm.h4cc.de/package/fuelphp/fieldset)

This package will replace the default Fieldset class provided by the FuelPHP v1.x core by the FuelPHP v2.0 fieldset package.

## Installing

Simply add `"fuelphp/fieldset": "dev-master"` to your `composer.json` and install.
Once the package reaches a suitable milestone a tagged release will be created.

## Getting started

Forms are created by first creating a container object, a `Form` or a `Fieldset`. You can then add `Inputs` to these containers.

```php
<?php

use Fuel\Fieldset\Form;
use Fuel\Fieldset\Input;

$form = new Form;

$form[] = new Input\Text('name');
$form[] = new Input\Submit('submit', [], 'GO!');

//This will repopulate the form with any submitted data
$form->repopulate();

//This will repopulate the form with the given data, the flag indicates wether to call `repopulate()` after or not
$form->populate($myData, true);
```

## InputElement types

The current `InputElement` classes exist.

 - Button
 - Checkbox
 - CheckboxGroup
 - Email
 - File
 - Hidden
 - Optgroup
 - Option
 - Password
 - Radio
 - RadioGroup
 - Reset
 - Select
 - Submit
 - Text
 - Textarea

Grouped check boxes and radio buttons now have their own logic for repopulation and naming when used in groups, hence the `ChecboxGroup` and `RadioGroup` classes. `Select` elements are comprised of `Option`s and `Optgroup`s.
For more info on check box/radio groups and selects please see [here](https://github.com/fuelphp/fieldset/wiki/Select-and-Radio-Checkbox-groups).


## Showing the form

Unlike v1 fieldsets a totally separate class is used to create the html for the form. Whilst each `InputElement` knows how to display itself in the most basic form the use of a `Renderer` allows for more complex behaviour to be achieved.
This can include things such as generating the form in a table or as a list. By default `SimpleRender` will render the form in a table, much the same as the v1 fieldsets did.
In the future other basic renderers might be added to the package to support things like list based forms out of the box. Pull/merge requests are always welcome.

The render classes are all used in the same basic way:

```php
<?php

use Fuel\Fieldset\Render;

$engine = new BasicRender();

$formHtml = $engine->render($form);
```

It is easily possible to create your own renderer if the default one does not suit your needs. For an example take a look at the `SimpleRender` code and additionally [here](https://github.com/fuelphp/fieldset/wiki/Advanced-form-rendering). If you do make your own renderer for a UI kit or css framework then please consider submitting a pull request!

### Included Renderers

Fieldset comes with a couple of basic renderes, a generic one that does not add any formatting or css and a Bootstrap3 based renderer that will build forms that are compatible with the Bootstrap CSS framework.

### 3rd party renderers

 - [Twig intergration](https://github.com/indigophp/fuelphp-fieldset-twig)
