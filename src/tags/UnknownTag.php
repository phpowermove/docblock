<?php
namespace gossi\docblock\tags;

/**
 * Represents an unknown tag.
 */
class UnknownTag extends AbstractTag {
	
	public function __construct($tagName, $content = '') {
		parent::__construct($tagName, $content);
	}
	
	protected function parse($content) {
		$this->setDescription($content);
	}
	
}
