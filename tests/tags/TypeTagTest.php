<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\TypeTag;

class TypeTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$type = new TypeTag('Foo ...$bar');
		$this->assertEquals('@type Foo ...$bar', $type->toString());
	}
	
}