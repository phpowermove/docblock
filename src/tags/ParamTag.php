<?php
namespace gossi\docblock\tags;

/**
 * Represents the @param tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/param.html
 */
class ParamTag extends AbstractVarTypeTag {

	public function __construct($content = '') {
		parent::__construct('param', $content);
	}
	
}
