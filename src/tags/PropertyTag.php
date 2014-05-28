<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property.html
 */
class PropertyTag extends AbstractVarTypeTag {

	public function __construct($content = '') {
		parent::__construct('property', $content);
	}
	
}
