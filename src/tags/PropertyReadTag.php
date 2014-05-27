<?php
namespace gossi\docblock\tags;

/**
 * Represents the @property-read tag.
 */
class PropertyReadTag extends TypeTag {

	public function __construct($content = '') {
		parent::__construct('property-read', $content);
	}
	
}
