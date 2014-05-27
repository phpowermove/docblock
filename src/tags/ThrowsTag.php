<?php
namespace gossi\docblock\tags;

/**
 * Represents the @throws tag.
 */
class ThrowsTag extends AbstractTypeTag {
	
	public function __construct($content = '') {
		parent::__construct('throws', $content);
	}
	
}
