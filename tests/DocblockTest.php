<?php
namespace gossi\docblock\tests;

use gossi\docblock\Docblock;
use gossi\docblock\tags\ThrowsTag;
use gossi\docblock\tests\fixtures\MyDocBlock;
use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\SeeTag;
use gossi\docblock\tags\SinceTag;
use gossi\docblock\tags\PropertyTag;
use gossi\docblock\tags\ReturnTag;
use gossi\docblock\tags\ParamTag;
use gossi\docblock\tags\UnknownTag;

class DocblockTest extends \PHPUnit_Framework_TestCase {

	public function testShortDescription() {
		$desc = 'Hello World';
		$docblock = new Docblock();

		$docblock->setShortDescription($desc);
		
		$this->assertEquals($desc, $docblock->getShortDescription());
	}
	
	public function testLongDescription() {
		$desc = 'Hello World';
		$docblock = new Docblock();
	
		$docblock->setLongDescription($desc);
	
		$this->assertEquals($desc, $docblock->getLongDescription());
	}
	
	public function testSimpleReadWrite() {
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
	
	public function testSingleLine() {
		$docblock = new Docblock('/** Single Line Doc */');
		$this->assertEquals('Single Line Doc', $docblock->getShortDescription());
	}
	
	public function testTags() {
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
		new Docblock(new \stdClass());
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
		$docblock = new Docblock($expected);
 		$this->assertEquals($expected, $docblock->toString());
	}
	
	public function testFromReflection() {
		$expected = '/**
 * Short Description.
 * 
 * @author gossi
 */';
		$reflection = new \ReflectionClass('\\gossi\\docblock\\tests\\fixtures\\ReflectionTestClass');
		$docblock = Docblock::create($reflection);
		
		$this->assertEquals($expected, '' . $docblock);
	}
	
	public function testTagSorting() {
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
	
	public function testEmpty() {
		$doc = new Docblock();
		$this->assertTrue($doc->isEmpty());
		
		$doc->setLongDescription('bla');
		$this->assertFalse($doc->isEmpty());
		
		$doc->setLongDescription(null);
		$this->assertTrue($doc->isEmpty());
		
		$doc->setShortDescription('bla');
		$this->assertFalse($doc->isEmpty());
		
		$doc->setShortDescription(null);
		$this->assertTrue($doc->isEmpty());

		$doc->appendTag(new SeeTag());
		$this->assertFalse($doc->isEmpty());
		
	}
	
}