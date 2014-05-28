<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\DeprecatedTag;

class DeprecatedTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$deprecated = new DeprecatedTag();
		$this->assertEquals('@deprecated', $deprecated->toString());
	}
	
}