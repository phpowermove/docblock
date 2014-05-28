<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\PropertyWriteTag;

class PropertyWriteTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$prop = new PropertyWriteTag('string $var');
		$this->assertEquals('@property-write string $var', $prop->toString());
	}
	
}