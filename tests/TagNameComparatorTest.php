<?php declare(strict_types=1);

namespace gossi\docblock\tests;

use gossi\docblock\TagNameComparator;
use phootwork\collection\ArrayList;
use PHPUnit\Framework\TestCase;

class TagNameComparatorTest extends TestCase {
	public function testComparison(): void {
		$list = new ArrayList(['author', 'since', 'see', 'param', 'author']);
		$list->sort(new TagNameComparator());

		$this->assertEquals(['see', 'author', 'author', 'since', 'param'], $list->toArray());
	}
}
