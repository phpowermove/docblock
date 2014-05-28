<?php
namespace gossi\docblock\tags;

/**
 * Represents an unkown tag.
 */
class UnknownTag extends AbstractTag {
	
	protected function parse($content) {
		$this->description = $content;
	}
	
}
