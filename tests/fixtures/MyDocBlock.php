<?php
namespace gossi\docblock\tests\fixtures;

use gossi\docblock\DocBlock;

class MyDocBlock extends DocBlock {
	
	protected function splitDocBlock($comment) {
		return array('', '', 'Invalid tag block');
	}
}