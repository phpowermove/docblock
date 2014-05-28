# Docblock

![DOI](https://zenodo.org/badge/3684/gossi/docblock.png)
[![Build Status](https://travis-ci.org/gossi/docblock.svg?branch=master)](https://travis-ci.org/gossi/docblock)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gossi/docblock/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gossi/docblock/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gossi/docblock/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gossi/docblock/?branch=master)

PHP DocBlock parser and generator. An API to read and write DocBlocks.

## Installation

Install via Composer:

```json
{
	"require": {
		"gossi/docblock": "~1"
	}
}
```

And inject the Composer autoloader into your source code:

```php
require_once 'path/to/vendor/autoload.php';
```

## Usage

### 1. Generate a DocBlock instance

a) Simple:

```php
use gossi\docblock\DocBlock;

$docblock = new DocBlock();
```

b) Create from string:

```php
use gossi\docblock\DocBlock;

$docblock = new DocBlock('/**
 * Short Description.
 *
 * Long Description.
 *
 * @author gossi
 */');
```

c) Create from reflection:

```php
use gossi\docblock\DocBlock;

$docblock = new DocBlock(new \ReflectionClass('MyClass'));
```

### 2. Manipulate tags

Get the tags:

```php
$tags = $docblock->getTags();
```

Get tags by name:

```php
$tags = $docblock->getTags('author');
```

Append a tag:

```php
use gossi\docblock\tags\AuthorTag;

$author = new AuthorTag();
$author->setName('gossi');
$docblock->appendTag($author);
```

or with fluent API:

```php
use gossi\docblock\tags\AuthorTag;

$docblock->appendTag(AuthorTag::create()
	->setName('gossi')
);
```

Check tag existence:

```php
$docblock->hasTag('author');
```

### 3. Get back the string

Call `toString()`:

```php
$docblock->toString();
```

or if you are in a write-context, the magical `__toString()` will take care of it:

```php
echo $docblock;
```

## Contributing

Feel free to fork and submit a pull request (don't forget the tests) and I am happy to merge.

## References

- This project uses the parsers from [phpDocumentor/ReflectionDocBlock](https://github.com/phpDocumentor/ReflectionDocBlock)

## Changelog

Version 1.0 - *May, 28th 2014*

* Initial release