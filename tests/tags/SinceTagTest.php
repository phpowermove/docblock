<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\SinceTag;

class SinceTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$since = new SinceTag('1.0 baz');
		$this->assertEquals('@since 1.0 baz', $since->toString());
	}
	
}