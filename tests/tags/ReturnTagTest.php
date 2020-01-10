<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\ReturnTag;
use PHPUnit\Framework\TestCase;

class ReturnTagTest extends TestCase {
	public function testReadWrite() {
		$return = new ReturnTag('Foo bar');
		$this->assertEquals('@return Foo bar', $return->toString());
	}
}
