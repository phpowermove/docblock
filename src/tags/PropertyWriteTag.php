<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property-write tag.
 */
class PropertyWriteTag extends TypeTag {

	public function __construct($content = '') {
		parent::__construct('property-write', $content);
	}
	
}
