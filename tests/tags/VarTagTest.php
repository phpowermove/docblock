<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\VarTag;

class VarTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$var = new VarTag('Foo ...$bar');
		$this->assertEquals('@var Foo ...$bar', $var->toString());
	}
	
}