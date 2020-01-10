<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the @since tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/since.html
 */
class SinceTag extends AbstractVersionTag {
	public function __construct(string $content = '') {
		parent::__construct('since', $content);
	}
}
