<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\PropertyReadTag;

class PropertyReadTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$prop = new PropertyReadTag('string $var');
		$this->assertEquals('@property-read string $var', $prop->toString());
	}
	
}