<?php
namespace gossi\docblock\tags;

/**
 * Represents an unknown tag.
 */
class UnknownTag extends AbstractDescriptionTag {
	
	/**
	 * Creates a new tag
	 * 
	 * @param string $tagName the tag name
	 * @param string $content the tags content
	 */
	public function __construct($tagName, $content = '') {
		parent::__construct($tagName, $content);
	}
	
	protected function parse($content) {
		$this->setDescription($content);
	}
	
	public function toString() {
		return sprintf('@%s %s', $this->tagName, $this->description);
	}
}
