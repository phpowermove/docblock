<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\ThrowsTag;

class ThrowsTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$ex = new ThrowsTag('\Exception oups');
		$this->assertEquals('@throws \Exception oups', $ex->toString());
	}
	
}