<?php
namespace gossi\docblock\tags;

/**
 * Represents the @version tag.
 */
class VersionTag extends AbstractVersionTag {
	
	public function __construct($content = '') {
		parent::__construct('version', $content);
	}

}
