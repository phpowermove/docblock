<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the `@method` tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/method.html
 */
class MethodTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('method', $content);
	}
}
