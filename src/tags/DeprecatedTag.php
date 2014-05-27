<?php
namespace gossi\docblock\tags;

/**
 * Represents the @deprecated tag.
 */
class DeprecatedTag extends AbstractVersionTag {

	public function __construct($content = '') {
		parent::__construct('deprecated', $content);
	}

}
