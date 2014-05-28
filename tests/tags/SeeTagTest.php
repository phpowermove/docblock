<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\SeeTag;

class SeeTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$see = new SeeTag('Dest::nation() 0815');
		$this->assertEquals('@see Dest::nation() 0815', $see->toString());
	}
	
	public function testReference() {
		$see = new SeeTag();
		$this->assertSame($see, $see->setReference('hier-lang'));
		$this->assertEquals('hier-lang', $see->getReference());
	}
	
}