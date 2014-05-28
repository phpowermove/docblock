<?php
namespace gossi\docblock\tags;

/**
 * Represents the @since tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/since.html
 */
class SinceTag extends AbstractVersionTag {
	
	public function __construct($content = '') {
		parent::__construct('since', $content);
	}
	
}
