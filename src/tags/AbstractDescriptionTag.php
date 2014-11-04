<?php
namespace gossi\docblock\tags;

/**
 * Abstract tag with a description
 */
abstract class AbstractDescriptionTag extends AbstractTag {

	protected $description;
	
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
		return $this;
	}

	
}
