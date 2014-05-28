<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\PropertyTag;

class PropertyTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$prop = new PropertyTag('string $var');
		$this->assertEquals('@property string $var', $prop->toString());
	}
	
}