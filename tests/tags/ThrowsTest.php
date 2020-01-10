<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\ThrowsTag;
use PHPUnit\Framework\TestCase;

class ThrowsTagTest extends TestCase {
	public function testReadWrite() {
		$ex = new ThrowsTag('\Exception oups');
		$this->assertEquals('@throws \Exception oups', $ex->toString());
	}
}
