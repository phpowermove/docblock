<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents tags which are in the format
 *
 *   @tag [Type] [Description] 
 */
abstract class AbstractTypeTag extends AbstractDescriptionTag {

	/** @var string */
	protected $type = '';

	protected function parse(string $content): void {
		$parts = preg_split('/\s+/Su', $content, 2);

		$this->type = $parts[0];
		$this->setDescription(isset($parts[1]) ? $parts[1] : '');
	}

	public function toString(): string {
		$type = $this->type ? $this->type . ' ' : '';

		return trim(sprintf('@%s %s%s', $this->tagName, $type, $this->description));
	}

	/**
	 * Returns the type
	 * 
	 * @return string the type
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * Sets the type
	 * 
	 * @param string $type the new type
	 *
	 * @return $this
	 */
	public function setType(string $type): self {
		$this->type = $type;

		return $this;
	}
}
