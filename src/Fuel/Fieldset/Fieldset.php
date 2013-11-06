<?php
/**
 * @package   Fuel\Fieldset
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Fieldset;

use Fuel\Common\Html;

/**
 * Defines a fieldset that can be added to a Form
 *
 * @package Fuel\Fieldset
 * @since   2.0
 * @author  Fuel Development Team
 */
class Fieldset extends InputContainer
{

	protected $_legend = null;

	/**
	 * Gets the legend for the Fieldset
	 *
	 * @return string
	 */
	public function getLegend()
	{
		return $this->_legend;
	}

	/**
	 * Sets the legend for the Fieldset.
	 *
	 * @param  string|null $legend Set to null (the default) to not display a legend
	 * @return Fieldset
	 */
	public function setLegend($legend)
	{
		$this->_legend = $legend;

		return $this;
	}

	/**
	 * Renders the Fieldset to html
	 *
	 * @param  Render $renderer
	 * @return string
	 */
	public function render(Render $renderer)
	{
		$legend = '';

		//Make sure the legend is added if needed
		if ( !is_null($this->getLegend()) )
		{
			$legend = Html::tag('legend', [], $this->getLegend());
		}

		//Makes sure the legend is added if one exists
		$elements = $legend;

		//Render all the elements
		foreach ( $this->getContents() as $element )
		{
			$elements .= "\n" . $renderer->render($element);
		}

		return Html::tag('fieldset', $this->getAttributes(), $elements);
	}

}
