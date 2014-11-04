<?php

namespace gossi\docblock\tags;

abstract class AbstractTag {
	
	protected $tagName;
	
	/**
	 * Creates a new tag instance
	 *
	 * @return $this
	 */
	public static function create($content = '') {
		return new static($content);
	}
	
	/**
	 * Creates a new tag instance
	 *
	 * @param string $tagName
	 * @param string $content
	 */
	protected function __construct($tagName, $content = '') {
		$this->tagName = $tagName;
		$this->parse($content);
	}
	
	/**
	 * Returns the tag name.
	 *
	 * @return string the tag name
	 */
	public function getTagName() {
		return $this->tagName;
	}

	/**
	 * Parses the given string
	 *
	 * @param string $content
	 */
	abstract protected function parse($content);
	
	abstract protected function toString();
	
	/**
	 * Magic toString() method
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->toString();
	}
}