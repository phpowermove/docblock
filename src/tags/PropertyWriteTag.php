<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @property-write tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property-write.html
 */
class PropertyWriteTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('property-write', $content);
	}
}
