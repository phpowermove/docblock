<?php
namespace gossi\docblock\tests;

use gossi\docblock\TagNameComparator;
use phootwork\collection\ArrayList;

class TagNameComparatorTest extends \PHPUnit_Framework_TestCase {
	
	public function testComparison() {
		$list = new ArrayList(['author', 'since', 'see', 'param', 'author']);
		$list->sort(new TagNameComparator());
		
		$this->assertEquals(['see', 'author', 'author', 'since', 'param'], $list->toArray());
	}
	
}
