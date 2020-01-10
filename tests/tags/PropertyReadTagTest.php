<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\PropertyReadTag;
use PHPUnit\Framework\TestCase;

class PropertyReadTagTest extends TestCase {
	public function testReadWrite(): void {
		$prop = new PropertyReadTag('string $var');
		$this->assertEquals('@property-read string $var', $prop->toString());
	}
}
