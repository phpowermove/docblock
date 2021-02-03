<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\UnknownTag;
use PHPUnit\Framework\TestCase;

class UnknownTagTest extends TestCase {
	public function testReadWrite(): void {
		$unknown = new UnknownTag('description');
		$unknown = $unknown->setTagName('my-tag');

		$this->assertEquals('@my-tag description', $unknown->toString());
		$this->assertEquals('my-tag', $unknown->getTagName());

		$this->assertEquals($unknown->toString(), '' . $unknown);

		$this->assertTrue(UnknownTag::create() instanceof UnknownTag);
	}
}
