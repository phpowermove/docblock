<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\PropertyTag;
use PHPUnit\Framework\TestCase;

class PropertyTagTest extends TestCase {
	public function testReadWrite() {
		$prop = new PropertyTag('string $var');
		$this->assertEquals('@property string $var', $prop->toString());
	}
}
