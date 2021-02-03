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
 * Tag Factory
 */
class TagFactory {

	/**
	 * @var array An array with a tag as a key, and an FQCN as the handling class.
	 */
	private static array $tagClassMap = [
			'author' => '\gossi\docblock\tags\AuthorTag',
			'deprecated' => '\gossi\docblock\tags\DeprecatedTag',
// 			'example' => '\gossi\docblock\tags\ExampleTag',
			'link' => '\gossi\docblock\tags\LinkTag',
			'method' => '\gossi\docblock\tags\MethodTag',
			'param' => '\gossi\docblock\tags\ParamTag',
			'property-read' => '\gossi\docblock\tags\PropertyReadTag',
			'property' => '\gossi\docblock\tags\PropertyTag',
			'property-write' => '\gossi\docblock\tags\PropertyWriteTag',
			'return' => '\gossi\docblock\tags\ReturnTag',
			'see' => '\gossi\docblock\tags\SeeTag',
			'since' => '\gossi\docblock\tags\SinceTag',
// 			'source' => '\gossi\docblock\tags\SourceTag',
			'throw' => '\gossi\docblock\tags\ThrowsTag',
			'throws' => '\gossi\docblock\tags\ThrowsTag',
			'type' => '\gossi\docblock\tags\TypeTag',
// 			'uses' => '\gossi\docblock\tags\UsesTag',
			'var' => '\gossi\docblock\tags\VarTag',
			'version' => '\gossi\docblock\tags\VersionTag'
	];

	/**
	 * Creates a new tag instance on the given name
	 * 
	 * @param string $tagName
	 * @param string $content
	 *
	 * @return AbstractTag
	 */
	public static function create(string $tagName, string $content = ''): AbstractTag {
		if (isset(self::$tagClassMap[$tagName])) {
			$class = self::$tagClassMap[$tagName];

			return new $class($content);
		}

		return new UnknownTag($tagName, $content);
	}
}
