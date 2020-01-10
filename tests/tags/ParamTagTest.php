<?php declare(strict_types=1);

namespace gossi\docblock\tests\tags;

use gossi\docblock\tags\ParamTag;
use PHPUnit\Framework\TestCase;

class ParamTagTest extends TestCase {
	public function testReadWrite(): void {
		$param = new ParamTag('string $a the string');

		$this->assertEquals('string', $param->getType());
		$this->assertEquals('$a', $param->getVariable());
		$this->assertEquals('the string', $param->getDescription());
		$this->assertFalse($param->isVariadic());
		$this->assertEquals('@param string $a the string', $param->toString());

		$param = new ParamTag('string ...$a');

		$this->assertEmpty($param->getDescription());
		$this->assertTrue($param->isVariadic());
		$this->assertEquals('@param string ...$a', $param->toString());
	}

	public function testType(): void {
		$type = 'int';
		$param = new ParamTag();

		$this->assertSame($param, $param->setType($type));
		$this->assertEquals($type, $param->getType());
	}

	public function testVariable(): void {
		$variable = '$v';
		$param = new ParamTag();

		$this->assertSame($param, $param->setVariable($variable));
		$this->assertEquals($variable, $param->getVariable());
	}

	public function testVariadic(): void {
		$param = new ParamTag();

		$this->assertSame($param, $param->setVariadic(true));
		$this->assertTrue($param->isVariadic());
	}
}
