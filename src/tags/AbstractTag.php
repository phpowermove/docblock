<?php
namespace gossi\docblock\tags;

/**
 * Abstract tag
 */
abstract class AbstractTag {

	protected $tagName;
	protected $description;
	
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
	 * Returns the description
	 * 
	 * @return string the description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 * 
	 * @param string $description the new description
	 * @return $this
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Parses the given string
	 * 
	 * @param string $content
	 */
	abstract protected function parse($content);
	
	/**
	 * Returns the string version of the tag in one line
	 *
	 * @return string
	 */
	public function toString() {
		return sprintf('@%s %s', $this->tagName, $this->description);
	}
	
	/**
	 * Magic toString() method
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->toString();
	}
	
}
