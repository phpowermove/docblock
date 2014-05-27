<?php
namespace gossi\docblock\tags;

/**
 * Represents the @since tag.
 */
class SinceTag extends AbstractVersionTag {
	
	public function __construct($content = '') {
		parent::__construct('since', $content);
	}
	
}
