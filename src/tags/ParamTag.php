<?php
namespace gossi\docblock\tags;

/**
 * Represents the @param tag.
 */
class ParamTag extends TypeTag {

	public function __construct($content = '') {
		parent::__construct('param', $content);
	}
	
}
