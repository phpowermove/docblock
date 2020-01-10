<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @param tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/param.html
 */
class ParamTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('param', $content);
	}
}
