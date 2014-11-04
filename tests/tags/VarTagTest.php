<?php
namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\VarTag;
use gossi\docblock\Docblock;

class VarTagTest extends \PHPUnit_Framework_TestCase {
	
	public function testReadWrite() {
		$var = new VarTag('Foo ...$bar');
		$this->assertEquals('@var Foo ...$bar', $var->toString());
	}
	
	public function testDocblock() {
		$expected = '/**
 * @var mixed $foo bar
 */';
		$docblock = new Docblock();
		$var = VarTag::create()
			->setType('mixed')
			->setVariable('foo')
			->setDescription('bar')
		;
		$docblock->appendTag($var);
		
		$this->assertEquals($expected, $docblock->toString());
	}
}