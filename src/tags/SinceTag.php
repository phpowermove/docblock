<?php declare(strict_types=1);
/*
 * This file is part of the Docblock package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

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
