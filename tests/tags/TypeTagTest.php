<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\TypeTag;
use PHPUnit\Framework\TestCase;

class TypeTagTest extends TestCase {
	public function testReadWrite(): void {
		$type = new TypeTag('Foo ...$bar');
		$this->assertEquals('@type Foo ...$bar', $type->toString());
	}
}
