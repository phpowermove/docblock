<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\LinkTag;

class LinkTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$link = new LinkTag('http://example.com');
		$this->assertEquals('http://example.com', $link->getUrl());
		$this->assertEquals('@link http://example.com', $link->toString());
		
		$link = new LinkTag('http://example.com desc');		
		$this->assertEquals('http://example.com', $link->getUrl());
		$this->assertEquals('desc', $link->getDescription());
		$this->assertEquals('@link http://example.com desc', $link->toString());
		
		$link = new LinkTag('http://.example.com desc');
		$this->assertNull($link->getUrl());
		$this->assertEquals('http://.example.com desc', $link->getDescription());
	}

	public function testUrl() {
		$url = 'http://example.com';
		$link = new LinkTag();
		
		$this->assertSame($link, $link->setUrl($url));
		$this->assertEquals($url, $link->getUrl());
	}

	public function testDescription() {
		$desc = 'desc';
		$link = new LinkTag();
		
		$this->assertSame($link, $link->setDescription($desc));		
		$this->assertEquals($desc, $link->getDescription());
	}

}
