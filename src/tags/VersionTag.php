<?php
namespace gossi\docblock\tags;

/**
 * Represents the @version tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/version.html
 */
class VersionTag extends AbstractVersionTag {
	
	public function __construct($content = '') {
		parent::__construct('version', $content);
	}

}
