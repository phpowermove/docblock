<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @var tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/var.html
 */
class VarTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('var', $content);
	}
}
