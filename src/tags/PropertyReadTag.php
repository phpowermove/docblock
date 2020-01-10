<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @property-read tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property-read.html
 */
class PropertyReadTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('property-read', $content);
	}
}
