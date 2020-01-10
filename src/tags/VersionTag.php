<?php declare(strict_types=1);
namespace gossi\docblock\tags;

/**
 * Represents the @version tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/version.html
 */
class VersionTag extends AbstractVersionTag {
	public function __construct(string $content = '') {
		parent::__construct('version', $content);
	}
}
