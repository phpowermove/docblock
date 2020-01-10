<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Abstract tag with a description
 */
abstract class AbstractDescriptionTag extends AbstractTag {

	/** @var string */
	protected $description = '';

	/**
	 * Returns the description
	 * 
	 * @return string the description
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * Sets the description
	 * 
	 * @param string $description the new description
	 *
	 * @return $this
	 */
	public function setDescription(string $description): self {
		$this->description = $description;

		return $this;
	}
}
