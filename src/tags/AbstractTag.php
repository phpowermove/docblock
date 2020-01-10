<?php declare(strict_types=1);

namespace gossi\docblock\tags;

abstract class AbstractTag {

	/** @var string */
	protected $tagName;

	/**
	 * Creates a new tag instance
	 *
	 * @return $this
	 */
	public static function create(string $content = '') {
		return new static($content);
	}

	/**
	 * Creates a new tag instance
	 *
	 * @param string $tagName
	 * @param string $content
	 */
	protected function __construct(string $tagName, string $content = '') {
		$this->tagName = $tagName;
		$this->parse($content);
	}

	/**
	 * Returns the tag name.
	 *
	 * @return string the tag name
	 */
	public function getTagName(): string {
		return $this->tagName;
	}

	/**
	 * Parses the given string
	 *
	 * @param string $content
	 */
	abstract protected function parse(string $content): void;

	abstract public function toString(): string;

	/**
	 * Magic toString() method
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->toString();
	}
}
