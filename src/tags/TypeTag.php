<?php
namespace gossi\docblock\tags;

/**
 * Represents the @type tag.
 */
class TypeTag extends AbstractVarTypeTag {
	
	public function __construct($content = '') {
		parent::__construct('type', $content);
	}

}
