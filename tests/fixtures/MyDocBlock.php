<?php
namespace gossi\docblock\tests\fixtures;

use gossi\docblock\Docblock;

class MyDocBlock extends Docblock {
	
	protected function splitDocblock($comment) {
		return array('', '', 'Invalid tag block');
	}
}