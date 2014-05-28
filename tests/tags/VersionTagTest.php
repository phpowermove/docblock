<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\VersionTag;

class VersionTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$version = new VersionTag('1.3.3.7 jupjup');
		$this->assertEquals('@version 1.3.3.7 jupjup', $version->toString());
		$this->assertEquals('jupjup', $version->getDescription());
		$this->assertEquals('1.3.3.7', $version->getVersion());
		$this->assertSame($version, $version->setVersion('3.14'));
		$this->assertEquals('3.14', $version->getVersion());
	}
	
}