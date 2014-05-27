<?php
namespace gossi\docblock\tags;

/**
 * Represents the @return tag.
 */
class ReturnTag extends AbstractTypeTag {
	
	public function __construct($content = '') {
		parent::__construct('return', $content);
	}

}
