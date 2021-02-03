<?php declare(strict_types=1);
/*
 * This file is part of the Docblock package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace gossi\docblock\tests;

use gossi\docblock\Docblock;
use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\ParamTag;
use gossi\docblock\tags\PropertyTag;
use gossi\docblock\tags\ReturnTag;
use gossi\docblock\tags\SeeTag;
use gossi\docblock\tags\SinceTag;
use gossi\docblock\tags\ThrowsTag;
use gossi\docblock\tags\UnknownTag;
use gossi\docblock\tests\fixtures\MyDocBlock;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DocblockTest extends TestCase {
	public function testShortDescription(): void {
		$desc = 'Hello World';
		$docblock = new Docblock();

		$docblock->setShortDescription($desc);

		$this->assertEquals($desc, $docblock->getShortDescription());
	}

	public function testLongDescription(): void {
		$desc = 'Hello World';
		$docblock = new Docblock();

		$docblock->setLongDescription($desc);

		$this->assertEquals($desc, $docblock->getLongDescription());
	}

	public function testSimpleReadWrite(): void {
		$expected = '/**
 * Short Description.
 *
 * Long Description.
 */';
		$docblock = new Docblock($expected);

		$this->assertEquals('Short Description.', $docblock->getShortDescription());
		$this->assertEquals('Long Description.', $docblock->getLongDescription());
		$this->assertEquals($expected, $docblock->toString());
	}

	public function testSingleLine(): void {
		$docblock = new Docblock('/** Single Line Doc */');
		$this->assertEquals('Single Line Doc', $docblock->getShortDescription());
	}

	public function testTags(): void {
		$expected = '/**
 * @see https://github.com/gossi/docblock
 * @author gossi
 * @author KH
 * @since 28.5.2014
 */';
		$docblock = new Docblock($expected);

		$tags = $docblock->getTags();
		$this->assertEquals(4, $tags->size());
		$this->assertTrue($docblock->hasTag('see'));
		$this->assertTrue($docblock->hasTag('author'));
		$this->assertTrue($docblock->hasTag('since'));
		$this->assertFalse($docblock->hasTag('license'));

		$authors = $docblock->getTags('author');
		$this->assertEquals(2, $authors->size());

		$this->assertEquals($expected, $docblock->toString());
		$this->assertSame($docblock, $docblock->appendTag(ThrowsTag::create()));

		$tags = $docblock->getTags();
		$this->assertEquals(5, $tags->size());

		$this->assertTrue($docblock->hasTag('author'));
		$this->assertFalse($docblock->hasTag('moooh'));
	}

	public function testInvalidTags(): void {
		$this->expectException(InvalidArgumentException::class);

		new MyDocBlock('');
	}

	public function testInvalidDocblockParameter(): void {
		$this->expectException(\TypeError::class);

		new Docblock(new \stdClass());
	}

	public function testMultilLongLineDescription(): void {
		$expected = '/**
 * Short Description.
 *
 * Long Description, which is very long and takes ages to reach the very last of the current line
 * before it brakes onto the next line
 * 
 * sdfasdf @tag
 *
 * @tag2 wurst multi-
 *     linee
 */';
		$docblock = new Docblock($expected);
		$this->assertEquals($expected, $docblock->toString());
	}

	public function testFromReflection(): void {
		$expected = '/**
 * Short Description.
 *
 * @author gossi
 */';
		$reflection = new \ReflectionClass('\\gossi\\docblock\\tests\\fixtures\\ReflectionTestClass');
		$docblock = Docblock::create($reflection);

		$this->assertEquals($expected, '' . $docblock);
	}

	public function testTagSorting(): void {
		$doc = new Docblock();

		$doc->appendTag(new AuthorTag());
		$doc->appendTag(new SeeTag());
		$doc->appendTag(new ThrowsTag());
		$doc->appendTag(new UnknownTag('wurst'));
		$doc->appendTag(new SinceTag());
		$doc->appendTag(new ParamTag());
		$doc->appendTag(new ParamTag());
		$doc->appendTag(new PropertyTag());
		$doc->appendTag(new ReturnTag());

		$actual = [];
		$expected = ['wurst', 'see', 'author', 'property', 'since', 'param', 'param', 'throws', 'return'];
		$sorted = $doc->getSortedTags();
		foreach ($sorted as $tag) {
			$actual[] = $tag->getTagName();
		}

		$this->assertEquals($expected, $actual);
	}

	public function testEmpty(): void {
		$doc = new Docblock();
		$this->assertTrue($doc->isEmpty());

		$doc->setLongDescription('bla');
		$this->assertFalse($doc->isEmpty());

		$doc->setLongDescription();
		$this->assertTrue($doc->isEmpty());

		$doc->setShortDescription('bla');
		$this->assertFalse($doc->isEmpty());

		$doc->setShortDescription();
		$this->assertTrue($doc->isEmpty());

		$doc->appendTag(new SeeTag());
		$this->assertFalse($doc->isEmpty());
	}

	public function testRemoveTag(): void {
		$expected = '/**
 * @see https://github.com/gossi/docblock
 * @author gossi
 * @author KH
 * @since 28.5.2014
 */';
		$docblock = new Docblock($expected);

		$tags = $docblock->getTags();
		$this->assertEquals(4, $tags->size());
		$this->assertTrue($docblock->hasTag('see'));
		$this->assertTrue($docblock->hasTag('author'));
		$this->assertTrue($docblock->hasTag('since'));

		$docblock->removeTags('author');

		$tags = $docblock->getTags();
		$this->assertEquals(2, $tags->size());
		$this->assertTrue($docblock->hasTag('see'));
		$this->assertTrue($docblock->hasTag('since'));
		$this->assertFalse($docblock->hasTag('author'));

		$docblock->removeTags('since');

		$tags = $docblock->getTags();
		$this->assertEquals(1, $tags->size());
		$this->assertTrue($docblock->hasTag('see'));
		$this->assertFalse($docblock->hasTag('since'));
	}
}
