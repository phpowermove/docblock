<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @type tag.
 */
class TypeTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('type', $content);
	}
}
