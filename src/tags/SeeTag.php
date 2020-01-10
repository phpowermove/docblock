<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @see tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/see.html
 */
class SeeTag extends AbstractDescriptionTag {

	/** @var string */
	protected $reference;

	public function __construct(string $content = '') {
		parent::__construct('see', $content);
	}

	protected function parse(string $content): void {
		$parts = preg_split('/\s+/Su', $content, 2);

		$this->reference = $parts[0];
		$this->setDescription(isset($parts[1]) ? $parts[1] : '');
	}

	public function toString(): string {
		return trim(sprintf('@see %s', trim($this->reference . ' ' . $this->description)));
	}

	/**
	 * Returns the reference
	 * 
	 * @return string the reference
	 */
	public function getReference(): string {
		return $this->reference;
	}

	/**
	 * Sets the reference
	 *
	 * @param string $reference a URL or FQSEN
	 *
	 * @return SeeTag
	 */
	public function setReference(string $reference): self {
		$this->reference = $reference;

		return $this;
	}
}
