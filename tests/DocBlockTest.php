<?php
namespace gossi\docblock\tests;

use gossi\docblock\DocBlock;
use gossi\docblock\tags\ThrowsTag;

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
 * @author gossi
 * @author KH
 * @see https://github.com/gossi/docblock
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
	public function testInvalidTagName() {
		new DocBlock('/** @v4r€able */');
	}
	
}