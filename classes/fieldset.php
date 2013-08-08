<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fieldset;

use Fuel\Common\Arr;
use Fuel\Fieldset\Exception\Deprecated;
use Fuel\Fieldset\Form;
use Fuel\Fieldset\Render\BasicRender;

/**
 * Fieldset core class extension
 *
 * This class will provide the interface between the Fuel v1.x class API
 * and the proposed FuelPHP v2.0 API
 */
class Fieldset extends \Fuel\Core\Fieldset
{
	/**
	 * @var  Fieldset
	 */
	protected static $instance;

	/**
	 * @var  array  contains references to all instantiations of Fieldset
	 */
	protected static $instances = array();

	/**
	 * @var \Fuel\Fieldset\Form
	 */
	protected $form;

	/**
	 * Create Fieldset object
	 *
	 * @param string Identifier for this fieldset
	 * @param array Configuration array
	 * @return Fieldset
	 */
	public static function forge($name = 'default', array $config = array())
	{
		if ($exists = static::instance($name))
		{
			\Error::notice('Fieldset with this name exists already, cannot be overwritten.');
			return $exists;
		}

		static::$instances[$name] = new static($name, $config);

		if ($name == 'default')
		{
			static::$instance = static::$instances[$name];
		}

		return static::$instances[$name];
	}

	/**
	 * Return a specific instance, or the default instance (is created if necessary)
	 *
	 * @param string driver id
	 * @return Fieldset
	 */
	public static function instance($instance = null)
	{
		if ($instance !== null)
		{
			if ( ! array_key_exists($instance, static::$instances))
			{
				return false;
			}

			return static::$instances[$instance];
		}

		if (static::$instance === null)
		{
			static::$instance = static::forge();
		}

		return static::$instance;
	}

	/**
	 * Object constructor
	 *
	 * @param  string
	 * @param  array
	 */
	protected function __construct($name, array $config = array())
	{
		// Grab the form attributes
		$formAttributes = Arr::get($config, 'form_attributes', array());

		$this->form = new Form();
		$this->form->setAttributes($formAttributes);
		$this->form->setName($name);
	}

	/**
	 * Gets the actual form object that is being used.
	 *
	 * @return Form
	 */
	protected function get_form_object()
	{
		return $this->form;
	}

	/**
	 * Get related Validation instance or create it
	 *
	 * @param   bool|Validation
	 * @return  Validation
	 */
	public function validation($instance = true)
	{
		//TODO: Implement this
	}

	/**
	 * Get related Form instance or create it
	 *
	 * @param   bool|Form
	 * @return  Form
	 */
	public function form($instance = true)
	{
		return \Form::forge();
	}

	/**
	 * Set the tag to be used for this fieldset
	 *
	 * @param  string  $tag
	 * @return  Fieldset       this, to allow chaining
	 */
	public function set_fieldset_tag($tag)
	{
		// The fieldset/form tag can now be set through custom renderers
		throw new Deprecated('This feature has been removed with the v2 fieldset package');
	}

	/**
	 * Set the parent Fieldset instance
	 *
	 * @param   Fieldset  parent fieldset to which this belongs
	 * @return  Fieldset
	 */
	public function set_parent(\Fuel\Core\Fieldset $fieldset)
	{
		// This has been removed, given the new way that forms are constructed it is no longer needed for a fieldset to
		// know about its parent.
		throw new Deprecated('This feature has been removed with the v2 fieldset package');
	}

	/**
	 * Factory for Fieldset_Field objects. Please note this no longer returns Fieldset_Field objects
	 *
	 * @param   string
	 * @param   string
	 * @param   array
	 * @param   array
	 * @return  Fieldset For method chaning
	 */
	public function add($name, $label = '', array $attributes = array(), array $rules = array())
	{
		if ($name instanceof Fuel\Core\Fieldset_Field)
		{
			// It's not possible to get the type from a Fieldset_Field so nothing we can do here
			throw new Deprecated('Adding Fieldset_Fields directly is not supported by the v2 to v1 interface');

		}
		elseif ($name instanceof Fieldset)
		{
			// Convert the Form instance into a Fieldset and add that to the current form
			$fieldset = new \Fuel\Fieldset\Fieldset();
			foreach ($name->get_form_object() as $item)
			{
				$fieldset[] = $item;
			}

			$this->form[] = $fieldset;
		}
		else if (empty($name) || (is_array($name) and empty($name['name'])))
		{
			throw new \InvalidArgumentException('Cannot create field without name.');
		}
		// Allow passing the whole config in an array, will overwrite other values if that's the case
		else if (is_array($name))
		{
			$attributes = $name;
			$label = isset($name['label']) ? $name['label'] : '';
			$rules = isset($name['rules']) ? $name['rules'] : array();
			$type = isset($name['type']) ? $name['type'] : 'text';
			$name = $name['name'];

			// TODO: validation
		}
		else
		{
			$type = isset($attributes['type']) ? $attributes['type'] : 'text';
		}

		// Build and add the new input object to the form
		$typeClass = $this->typeToClass($type);

		$field = new $typeClass;
		$field->setAttributes($attributes);
		$field->setName($name);
		$field->setLabel($label);
		$this->form[] = $field;

		return $this;
	}

	/**
	 * Returns a class name for a given type
	 *
	 * @param  string $type
	 * @return string
	 */
	protected function typeToClass($type)
	{
		return 'Fuel\Fieldset\Input\\'.ucfirst($type);
	}

	/**
	 * Add a new Fieldset_Field before an existing field in a Fieldset
	 *
	 * @param   string  $name
	 * @param   string  $label
	 * @param   array   $attributes
	 * @param   array   $rules
	 * @param   string  $fieldname   fieldname before which the new field is inserted in the fieldset
	 * @return  Fieldset_Field
	 */
	public function add_before($name, $label = '', array $attributes = array(), array $rules = array(), $fieldname = null)
	{
		//TODO: Implement this
	}

	/**
	 * Add a new Fieldset_Field after an existing field in a Fieldset
	 *
	 * @param   string  $name
	 * @param   string  $label
	 * @param   array   $attributes
	 * @param   array   $rules
	 * @param   string  $fieldname   fieldname after which the new field is inserted in the fieldset
	 * @return  Fieldset_Field
	 */
	public function add_after($name, $label = '', array $attributes = array(), array $rules = array(), $fieldname = null)
	{
		//TODO: Implement this
	}

	/**
	 * Get Field instance
	 *
	 * @param   string|null           field name or null to fetch an array of all
	 * @param   bool                  whether to get the fields array or flattened array
	 * @param   bool                  whether to include tabular form fields in the flattened array
	 * @return  Fieldset_Field|false  returns false when field wasn't found
	 */
	public function field($name = null, $flatten = false, $tabular_form = true)
	{
		//TODO: Implement this
	}

	/**
	 * Add a model's fields
	 * The model must have a method "set_form_fields" that takes this Fieldset instance
	 * and adds fields to it.
	 *
	 * @param   string|Object  either a full classname (including full namespace) or object instance
	 * @param   array|Object   array or object that has the exactly same named properties to populate the fields
	 * @param   string         method name to call on model for field fetching
	 * @return  Fieldset       this, to allow chaining
	 */
	public function add_model($class, $instance = null, $method = 'set_form_fields')
	{
		//TODO: Implement this
	}

	/**
	 * Sets a config value on the fieldset
	 *
	 * @param   string
	 * @param   mixed
	 * @return  Fieldset  this, to allow chaining
	 */
	public function set_config($config, $value = null)
	{
		//TODO: Implement this
	}

	/**
	 * Get a single or multiple config values by key
	 *
	 * @param   string|array  a single key or multiple in an array, empty to fetch all
	 * @param   mixed         default output when config wasn't set
	 * @return  mixed|array   a single config value or multiple in an array when $key input was an array
	 */
	public function get_config($key = null, $default = null)
	{
		//TODO: Implement this
	}

	/**
	 * Populate the form's values using an input array or object
	 *
	 * @param   array|object
	 * @param   bool
	 * @return  Fieldset  this, to allow chaining
	 */
	public function populate($input, $repopulate = false)
	{
		$this->form->populate($input);

		if ($repopulate === true)
		{
			$this->repopulate();
		}

		return $this;
	}

	/**
	 * Set all fields to the input from get or post (depends on the form method attribute)
	 *
	 * @return  Fieldset      this, to allow chaining
	 */
	public function repopulate()
	{
		$this->form->repopulate();
		return $this;
	}

	/**
	 * Build the fieldset HTML
	 *
	 * @return  string
	 */
	public function build($action = null)
	{
		$renderer = new BasicRender();

		return $renderer->render($this->form);
	}

	/**
	 * Enable a disabled field from being build
	 *
	 * @return  Fieldset      this, to allow chaining
	 */
	public function enable($name = null)
	{
		//TODO: Implement this
		throw new Deprecated('This functionality is currently not available through the v2 to v1 interface layer');
	}

	/**
	 * Disable a field from being build
	 *
	 * @return  Fieldset      this, to allow chaining
	 */
	public function disable($name = null)
	{
		//TODO: Implement this
		throw new Deprecated('This functionality is currently not available through the v2 to v1 interface layer');
	}

	/**
	 * Magic method toString that will build this as a form
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return $this->build();
	}

	/**
	 * Return parent Fieldset
	 *
	 * @return Fieldset
	 */
	public function parent()
	{
		//TODO: Implement this
		throw new Deprecated('This functionality is currently not available through the v2 to v1 interface layer');
	}

	/**
	 * Return the child fieldset instances
	 *
	 * @return  array
	 */
	public function children()
	{
		//TODO: Implement this
		throw new Deprecated('This functionality is currently not available through the v2 to v1 interface layer');
	}

	/**
	 * Alias for $this->validation()->input()
	 *
	 * @return  mixed
	 */
	public function input($field = null)
	{
		//TODO: Implement this
	}

	/**
	 * Alias for $this->validation()->validated()
	 *
	 * @return  mixed
	 */
	public function validated($field = null)
	{
		//TODO: Implement this
	}

	/**
	 * Alias for $this->validation()->error()
	 *
	 * @return  Validation_Error|array
	 */
	public function error($field = null)
	{
		//TODO: Implement this
	}

	/**
	 * Alias for $this->validation()->show_errors()
	 *
	 * @return  string
	 */
	public function show_errors(array $config = array())
	{
		//TODO: Implement this
	}

	/**
	 * Get the fieldset name
	 *
	 * @return string
	 */
	public function get_name()
	{
		return $this->form->getName();
	}

	/**
	 * Enable or disable the tabular form feature of this fieldset
	 *
	 * @param  string  Model on which to define the tabular form
	 * @param  string  Relation of the Model on the tabular form is modeled
	 * @param  array  Collection of Model objects from a many relation
	 * @param  int  Number of empty rows to generate
	 *
	 * @return  Fieldset  this, to allow chaining
	 */
	public function set_tabular_form($model, $relation, $parent, $blanks = 1)
	{
		throw new Deprecated('Tabular forms are currently not available through the v2 to v1 interface layer');
	}

	/**
	 * return the tabular form relation of this fieldset
	 *
	 * @return  bool
	 */
	public function get_tabular_form()
	{
		throw new Deprecated('Tabular forms are currently not available through the v2 to v1 interface layer');
	}

}
