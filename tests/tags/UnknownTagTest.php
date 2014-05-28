<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\UnknownTag;

class UnknownTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$unknown = new UnknownTag('my-tag', 'desscription');
		
		$this->assertEquals('@my-tag desscription', $unknown->toString());
		$this->assertEquals('my-tag', $unknown->getTagName());
		
		$this->assertEquals($unknown->toString(), '' . $unknown);
		
		$this->assertTrue(UnknownTag::create() instanceof UnknownTag);
	}
	
}