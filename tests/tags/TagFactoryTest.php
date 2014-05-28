<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\TagFactory;
use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\UnknownTag;

class TagFactoryTest extends \PHPUnit_Framework_TestCase {
	
	public function testFactory() {
		$factory = new TagFactory();
		
		$author = $factory->create('author', 'lil-g');
		$this->assertTrue($author instanceof AuthorTag);
		$this->assertEquals('lil-g', $author->getName());
		
		$unknown = $factory->create('wurst');
		$this->assertTrue($unknown instanceof UnknownTag);
		$this->assertEquals('wurst', $unknown->getTagName());
	}
	
}