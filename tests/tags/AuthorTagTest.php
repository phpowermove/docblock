<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\AuthorTag;

class AuthorTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$author = new AuthorTag('gossi <hans@wurst.de>');
		
		$this->assertEquals('gossi', $author->getName());
		$this->assertEquals('hans@wurst.de', $author->getEmail());
		$this->assertEquals('@author gossi <hans@wurst.de>', $author->toString());
		
		$author = new AuthorTag('lil-g');
		
		$this->assertEquals('lil-g', $author->getName());
		$this->assertEmpty($author->getEmail());
		$this->assertEquals('@author lil-g', $author->toString());
	}
	
	public function testName() {
		$name = 'gossi';
		$author = new AuthorTag();
		
		$this->assertSame($author, $author->setName($name));
		$this->assertEquals($name, $author->getName());
	}
	
	public function testEmail() {
		$email = 'hans@wurst.de';
		$author = new AuthorTag();
		
		$this->assertSame($author, $author->setEmail($email));		
		$this->assertEquals($email, $author->getEmail());
	}
}