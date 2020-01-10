<?php declare(strict_types=1);
namespace gossi\docblock\tests\fixtures;

use gossi\docblock\Docblock;

class MyDocBlock extends Docblock {
	protected function splitDocblock($comment): array {
		return ['', '', 'Invalid tag block'];
	}
}
