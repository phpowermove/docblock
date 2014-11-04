<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\LicenseTag;

class LicenseTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$license = new LicenseTag('MIT');
		
		$this->assertEquals('MIT', $license->getLicense());
		$this->assertEquals('@license MIT', $license->toString());
		
		$license = new LicenseTag('http://opensource.org/licenses/MIT MIT');
		
		$this->assertEquals('MIT', $license->getLicense());
		$this->assertEquals('http://opensource.org/licenses/MIT', $license->getUrl());
		$this->assertEquals('@license http://opensource.org/licenses/MIT MIT', $license->toString());
	}
	
	public function testLicense() {
		$name = 'gossi';
		$license = new LicenseTag();
		
		$this->assertSame($license, $license->setLicense($name));
		$this->assertEquals($name, $license->getLicense());
	}
	
	public function testUrl() {
		$url = 'http://opensource.org/licenses/MIT';
		$license = new LicenseTag();
		
		$this->assertSame($license, $license->setUrl($url));		
		$this->assertEquals($url, $license->getUrl());
	}
}