<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property-read tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property-read.html
 */
class PropertyReadTag extends AbstractVarTypeTag {

	public function __construct($content = '') {
		parent::__construct('property-read', $content);
	}
	
}
