<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\ReturnTag;

class ReturnTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$return = new ReturnTag('Foo bar');
		$this->assertEquals('@return Foo bar', $return->toString());
	}
	
}