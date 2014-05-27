<?php
namespace gossi\docblock\tags;

/**
 * Tag Factory
 */
class TagFactory {
	
	/**
	 * @var array An array with a tag as a key, and an FQCN as the handling class.
	 */
	private static $tagClassMap = array(
			'author' => '\gossi\docblock\tag\AuthorTag',
			'deprecated' => '\gossi\docblock\tag\DeprecatedTag',
// 			'example' => '\gossi\docblock\tag\ExampleTag',
// 			'link' => '\gossi\docblock\tag\LinkTag',
// 			'method' => '\gossi\docblock\tag\MethodTag',
			'param' => '\gossi\docblock\tag\ParamTag',
			'property-read' => '\gossi\docblock\tag\PropertyReadTag',
			'property' => '\gossi\docblock\tag\PropertyTag',
			'property-write' => '\gossi\docblock\tag\PropertyWriteTag',
			'return' => '\gossi\docblock\tag\ReturnTag',
			'see' => '\gossi\docblock\tag\SeeTag',
			'since' => '\gossi\docblock\tag\SinceTag',
// 			'source' => '\gossi\docblock\tag\SourceTag',
			'throw' => '\gossi\docblock\tag\ThrowsTag',
			'throws' => '\gossi\docblock\tag\ThrowsTag',
			'type' => '\gossi\docblock\tag\TypeTag',
// 			'uses' => '\gossi\docblock\tag\UsesTag',
			'var' => '\gossi\docblock\tag\VarTag',
			'version' => '\gossi\docblock\tag\VersionTag'
	);
	
	/**
	 * Creates a new tag instance on the given name
	 * 
	 * @param string $tagName
	 * @param string $content
	 * @return AbstractTag
	 */
	public static function create($tagName, $content = '') {
		if (in_array($tagName, self::$tagClassMap)) {
			$class = self::$tagClassMap[$tagName];
			return new $class($content);
		} else {
			return new UnknownTag($tagName, $content);
		}
	}
	
}
