<?php
namespace gossi\docblock\tests;

use gossi\docblock\DocBlock;
use gossi\docblock\tags\ThrowsTag;
use gossi\docblock\tests\fixtures\MyDocBlock;
use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\SeeTag;
use gossi\docblock\tags\SinceTag;
use gossi\docblock\tags\PropertyTag;
use gossi\docblock\tags\ReturnTag;
use gossi\docblock\tags\ParamTag;
use gossi\docblock\tags\UnknownTag;

class DocBlockTest extends \PHPUnit_Framework_TestCase {

	public function testShortDescription() {
		$desc = 'Hello World';
		$docblock = new DocBlock();

		$docblock->setShortDescription($desc);
		
		$this->assertEquals($desc, $docblock->getShortDescription());
	}
	
	public function testLongDescription() {
		$desc = 'Hello World';
		$docblock = new DocBlock();
	
		$docblock->setLongDescription($desc);
	
		$this->assertEquals($desc, $docblock->getLongDescription());
	}
	
	public function testSimpleReadWrite() {
		$expected = '/**
 * Short Description.
 * 
 * Long Description.
 */';
		$docblock = new DocBlock($expected);
		
		$this->assertEquals('Short Description.', $docblock->getShortDescription());
		$this->assertEquals('Long Description.', $docblock->getLongDescription());
		$this->assertEquals($expected, $docblock->toString());
	}
	
	public function testSingleLine() {
		$docblock = new DocBlock('/** Single Line Doc */');
		$this->assertEquals('Single Line Doc', $docblock->getShortDescription());
	}
	
	public function testTags() {
		$expected = '/**
 * @see https://github.com/gossi/docblock
 * @author gossi
 * @author KH
 * @since 28.5.2014
 */';
		$docblock = new DocBlock($expected);
		
		$tags = $docblock->getTags();
		$this->assertEquals(4, count($tags));
		
		$authors = $docblock->getTags('author');
		$this->assertEquals(2, count($authors));
		
		$this->assertEquals($expected, $docblock->toString());
		$this->assertSame($docblock, $docblock->appendTag(ThrowsTag::create()));
		
		$tags = $docblock->getTags();
		$this->assertEquals(5, count($tags));
		
		$this->assertTrue($docblock->hasTag('author'));
		$this->assertFalse($docblock->hasTag('moooh'));
	}
	
	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testInvalidTags() {
		new MyDocBlock('');
	}
	
	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testInvalidDocblockParameter() {
		new DocBlock(new \stdClass());
	}
	
	public function testMultilLongLineDescription() {
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
		$docblock = new DocBlock($expected);
 		$this->assertEquals($expected, $docblock->toString());
	}
	
	public function testFromReflection() {
		$expected = '/**
 * Short Description.
 * 
 * @author gossi
 */';
		$reflection = new \ReflectionClass('\\gossi\\docblock\\tests\\fixtures\\ReflectionTestClass');
		$docblock = DocBlock::create($reflection);
		
		$this->assertEquals($expected, '' . $docblock);
	}
	
	public function testTagSorting() {
		$doc = new DocBlock();
		
		$doc->appendTag(new AuthorTag());
		$doc->appendTag(new SeeTag());
		$doc->appendTag(new ThrowsTag());
		$doc->appendTag(new UnknownTag('wurst'));
		$doc->appendTag(new SinceTag());
		$doc->appendTag(new ParamTag());
		$doc->appendTag(new PropertyTag());
		$doc->appendTag(new ReturnTag());
		
		$actual = [];
		$expected = ['wurst', 'see', 'author', 'property', 'since', 'param', 'throws', 'return'];
		$sorted = $doc->getSortedTags();
		foreach ($sorted as $tag) {
			$actual[] = $tag->getTagName();
		}
		
		$this->assertEquals($expected, $actual);
	}
	
}