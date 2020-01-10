<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents the `@deprecated` tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/deprecated.html
 */
class DeprecatedTag extends AbstractVersionTag {
	public function __construct(string $content = '') {
		parent::__construct('deprecated', $content);
	}
}
