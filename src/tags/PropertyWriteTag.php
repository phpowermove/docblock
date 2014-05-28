<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property-write tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property-write.html
 */
class PropertyWriteTag extends AbstractVarTypeTag {

	public function __construct($content = '') {
		parent::__construct('property-write', $content);
	}
	
}
