<?php
namespace gossi\docblock\tests;

use gossi\docblock\DocBlock;

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
	
}