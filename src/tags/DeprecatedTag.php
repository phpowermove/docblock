<?php
namespace gossi\docblock\tags;

/**
 * Represents the @deprecated tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/deprecated.html
 */
class DeprecatedTag extends AbstractVersionTag {

	public function __construct($content = '') {
		parent::__construct('deprecated', $content);
	}
	
}
