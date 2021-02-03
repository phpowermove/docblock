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
 * Represents the @property tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/property.html
 */
class PropertyTag extends AbstractVarTypeTag {
	public function __construct(string $content = '') {
		parent::__construct('property', $content);
	}
}
