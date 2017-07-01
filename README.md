# Docblock

[![License](https://img.shields.io/github/license/gossi/docblock.svg?style=flat-square)](https://packagist.org/packages/gossi/docblock)
[![Latest Stable Version](https://img.shields.io/packagist/v/gossi/docblock.svg?style=flat-square)](https://packagist.org/packages/gossi/docblock)
[![Total Downloads](https://img.shields.io/packagist/dt/gossi/docblock.svg?style=flat-square&colorB=007ec6)](https://packagist.org/packages/gossi/docblock)<br>
[![Build Status](https://img.shields.io/scrutinizer/build/g/gossi/docblock.svg?style=flat-square)](https://travis-ci.org/gossi/docblock)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/gossi/docblock.svg?style=flat-square)](https://scrutinizer-ci.com/g/gossi/docblock)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/gossi/docblock.svg?style=flat-square)](https://scrutinizer-ci.com/g/gossi/docblock)

PHP Docblock parser and generator. An API to read and write Docblocks.

## Installation

Install via Composer:

```
composer require gossi/docblock
```

## Usage

### 1. Generate a Docblock instance

a) Simple:

```php
use gossi\docblock\Docblock;

$docblock = new Docblock();
```

b) Create from string:

```php
use gossi\docblock\Docblock;

$docblock = new Docblock('/**
 * Short Description.
 *
 * Long Description.
 *
 * @author gossi
 */');
```

c) Create from reflection:

```php
use gossi\docblock\Docblock;

$docblock = new Docblock(new \ReflectionClass('MyClass'));
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

Refer to [Releases](https://github.com/gossi/docblock/releases)