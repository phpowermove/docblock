<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\TagFactory;
use gossi\docblock\tags\UnknownTag;
use PHPUnit\Framework\TestCase;

class TagFactoryTest extends TestCase {
	public function testFactory(): void {
		$factory = new TagFactory();

		$author = $factory->create('author', 'lil-g');
		$this->assertTrue($author instanceof AuthorTag);
		$this->assertEquals('lil-g', $author->getName());

		$unknown = $factory->create('wurst');
		$this->assertTrue($unknown instanceof UnknownTag);
		$this->assertEquals('wurst', $unknown->getTagName());
	}
}
