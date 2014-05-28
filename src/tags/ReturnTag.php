<?php
namespace gossi\docblock\tags;

/**
 * Represents the @return tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/return.html
 */
class ReturnTag extends AbstractTypeTag {
	
	public function __construct($content = '') {
		parent::__construct('return', $content);
	}

}
