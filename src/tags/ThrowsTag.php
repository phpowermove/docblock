<?php
namespace gossi\docblock\tags;

/**
 * Represents the @throws tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/throws.html
 */
class ThrowsTag extends AbstractTypeTag {
	
	public function __construct($content = '') {
		parent::__construct('throws', $content);
	}
	
}
