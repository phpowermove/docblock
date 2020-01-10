<?php declare(strict_types=1);

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
	public function __construct(string $tagName, string $content = '') {
		parent::__construct($tagName, $content);
	}

	protected function parse(string $content): void {
		$this->setDescription($content);
	}

	public function toString(): string {
		return sprintf('@%s %s', $this->tagName, $this->description);
	}
}
