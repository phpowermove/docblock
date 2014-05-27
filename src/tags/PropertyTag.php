<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property tag.
 */
class PropertyTag extends TypeTag {

	public function __construct($content = '') {
		parent::__construct('property', $content);
	}
	
}
