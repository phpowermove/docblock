<?php declare(strict_types=1);

namespace gossi\docblock;

use gossi\docblock\tags\AbstractTag;
use gossi\docblock\tags\TagFactory;
use InvalidArgumentException;
use LogicException;
use phootwork\collection\ArrayList;
use phootwork\collection\Map;
use phootwork\lang\Comparator;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionProperty;

class Docblock {

	/** @var string */
	protected $shortDescription;

	/** @var string */
	protected $longDescription;

	/** @var ArrayList */
	protected $tags;

	/** @var null|Comparator */
	protected $comparator = null;

	const REGEX_TAGNAME = '[\w\-\_\\\\]+';

	/**
	 * Static docblock factory
	 * 
	 * @param ReflectionFunctionAbstract|ReflectionClass|ReflectionProperty|string $docblock a docblock to parse
	 *
	 * @return $this
	 */
	public static function create($docblock = ''): self {
		return new static($docblock);
	}

	/**
	 * Creates a new docblock instance and parses the initial string or reflector object if given
	 * 
	 * @param ReflectionFunctionAbstract|ReflectionClass|ReflectionProperty|string $docblock a docblock to parse
	 */
	public function __construct($docblock = '') {
		$this->tags = new ArrayList();
		$this->parse($docblock);
	}

	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 *
	 * @param ReflectionFunctionAbstract|ReflectionClass|ReflectionProperty|string $docblock
	 *
	 * @throws InvalidArgumentException if there is no getDocCommect() method available
	 */
	protected function parse($docblock): void {
		if (is_object($docblock)) {
			if (!method_exists($docblock, 'getDocComment')) {
				throw new InvalidArgumentException('Invalid object passed; the given ' .
						'reflector must support the getDocComment method');
			}

			$docblock = $docblock->getDocComment();
		}

		$docblock = $this->cleanInput($docblock);

		[$short, $long, $tags] = $this->splitDocBlock($docblock);
		$this->shortDescription = $short;
		$this->longDescription = $long;
		$this->parseTags($tags);
	}

	/**
	 * Strips the asterisks from the DocBlock comment.
	 * 
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 *
	 * @param string $comment String containing the comment text.
	 *
	 * @return string
	 */
	protected function cleanInput(string $comment): string {
		$comment = trim(preg_replace('#[ \t]*(?:\/\*\*|\*\/|\*)?[ \t]{0,1}(.*)?#u', '$1', $comment));

		// reg ex above is not able to remove */ from a single line docblock
		if (substr($comment, -2) == '*/') {
			$comment = trim(substr($comment, 0, -2));
		}

		// normalize strings
		$comment = str_replace(["\r\n", "\r"], "\n", $comment);

		return $comment;
	}

	/**
	 * Splits the Docblock into a short description, long description and
	 * block of tags.
	 * 
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 *
	 * @param string $comment Comment to split into the sub-parts.
	 *
	 * @author RichardJ Special thanks to RichardJ for the regex responsible
	 *     for the split.
	 *
	 * @return string[] containing the short-, long description and an element
	 *     containing the tags.
	 */
	protected function splitDocBlock(string $comment): array {
		$matches = [];

		if (strpos($comment, '@') === 0) {
			$matches = ['', '', $comment];
		} else {
			// clears all extra horizontal whitespace from the line endings
			// to prevent parsing issues
			$comment = preg_replace('/\h*$/Sum', '', $comment);

			/*
			 * Splits the docblock into a short description, long description and
			 * tags section
			 * - The short description is started from the first character until
			 *   a dot is encountered followed by a newline OR
			 *   two consecutive newlines (horizontal whitespace is taken into
			 *   account to consider spacing errors)
			 * - The long description, any character until a new line is
			 *   encountered followed by an @ and word characters (a tag).
			 *   This is optional.
			 * - Tags; the remaining characters
			 *
			 * Big thanks to RichardJ for contributing this Regular Expression
			 */
			preg_match(
				'/
		        \A (
		          [^\n.]+
		          (?:
		            (?! \. \n | \n{2} ) # disallow the first seperator here
		            [\n.] (?! [ \t]* @\pL ) # disallow second seperator
		            [^\n.]+
		          )*
		          \.?
		        )
		        (?:
		          \s* # first seperator (actually newlines but it\'s all whitespace)
		          (?! @\pL ) # disallow the rest, to make sure this one doesn\'t match,
		          #if it doesn\'t exist
		          (
		            [^\n]+
		            (?: \n+
		              (?! [ \t]* @\pL ) # disallow second seperator (@param)
		              [^\n]+
		            )*
		          )
		        )?
		        (\s+ [\s\S]*)? # everything that follows
		        /ux',
				$comment,
				$matches
			);
			array_shift($matches);
		}

		while (count($matches) < 3) {
			$matches[] = '';
		}

		return $matches;
	}

	/**
	 * Parses the tags
	 * 
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 *
	 * @param string $tags
	 *
	 * @throws LogicException
	 * @throws InvalidArgumentException
	 */
	protected function parseTags(string $tags): void {
		$tags = trim($tags);
		if (!empty($tags)) {

			// sanitize lines
			$result = [];
			foreach (explode("\n", $tags) as $line) {
				if ($this->isTagLine($line) || count($result) == 0) {
					$result[] = $line;
				} else {
					$result[count($result) - 1] .= "\n" . $line;
				}
			}

			// create proper Tag objects
			if (count($result)) {
				$this->tags->clear();
				foreach ($result as $line) {
					$this->tags->add($this->parseTag($line));
				}
			}
		}
	}

	/**
	 * Checks whether the given line is a tag line (= starts with @) or not
	 * 
	 * @param string $line
	 *
	 * @return bool
	 */
	protected function isTagLine(string $line): bool {
		return isset($line[0]) && $line[0] == '@';
	}

	/**
	 * Parses an individual tag line
	 * 
	 * @param string $line
	 *
	 * @throws InvalidArgumentException
	 *
	 * @return AbstractTag
	 */
	protected function parseTag(string $line): AbstractTag {
		$matches = [];
		if (!preg_match('/^@(' . self::REGEX_TAGNAME . ')(?:\s*([^\s].*)|$)?/us', $line, $matches)) {
			throw new InvalidArgumentException('Invalid tag line detected: ' . $line);
		}

		$tagName = $matches[1];
		$content = isset($matches[2]) ? $matches[2] : '';

		return TagFactory::create($tagName, $content);
	}

	/**
	 * Returns the short description
	 * 
	 * @return string the short description
	 */
	public function getShortDescription(): string {
		return $this->shortDescription;
	}

	/**
	 * Sets the short description
	 * 
	 * @param string $description the new description     
	 *
	 * @return $this   	
	 */
	public function setShortDescription(string $description = ''): self {
		$this->shortDescription = $description;

		return $this;
	}

	/**
	 * Returns the long description
	 *
	 * @return string the long description
	 */
	public function getLongDescription(): string {
		return $this->longDescription;
	}

	/**
	 * Sets the long description
	 * 
	 * @param string $description the new description
	 *
	 * @return $this
	 */
	public function setLongDescription(string $description = ''): self {
		$this->longDescription = $description;

		return $this;
	}

	/**
	 * Adds a tag to this docblock
	 * 
	 * @param AbstractTag $tag
	 *
	 * @return $this
	 */
	public function appendTag(AbstractTag $tag): self {
		$this->tags->add($tag);

		return $this;
	}

	/**
	 * removes tags (by tag name)
	 *
	 * @param string $tagName
	 */
	public function removeTags(string $tagName = ''): void {
		$this->tags = $this->tags->filter(function (AbstractTag $tag) use ($tagName): bool {
			return $tagName !== $tag->getTagName();
		});
	}

	/**
	 * Checks whether a tag is present
	 * 
	 * @param string $tagName
	 *
	 * @return bool
	 */
	public function hasTag(string $tagName): bool {
		return $this->tags->search($tagName, function (AbstractTag $tag, string $query): bool {
			return $tag->getTagName() == $query;
		});
	}

	/**
	 * Gets tags (by tag name)
	 * 
	 * @param string $tagName
	 *
	 * @return ArrayList the tags
	 */
	public function getTags(string $tagName = null): ArrayList {
		return $this->tags->filter(function (AbstractTag $tag) use ($tagName): bool {
			return $tagName === null || $tag->getTagName() == $tagName;
		});
	}

	/**
	 * A list of tags sorted by tag-name
	 * 
	 * @return ArrayList
	 */
	public function getSortedTags(): ArrayList {
		if ($this->comparator === null) {
			$this->comparator = new TagNameComparator();
		}

		// 1) group by tag name
		$group = new Map();
		foreach ($this->tags->toArray() as $tag) {
			if (!$group->has($tag->getTagName())) {
				$group->set($tag->getTagName(), new ArrayList());
			}

			$group->get($tag->getTagName())->add($tag);
		}

		// 2) Sort the group by tag name
		$group->sortKeys(new TagNameComparator());

		// 3) flatten the group
		$sorted = new ArrayList();
		foreach ($group->values()->toArray() as $tags) {
			$sorted->add(...$tags);
		}

		return $sorted;
	}

	/**
	 * Returns true when there is no content in the docblock
	 *  
	 * @return bool
	 */
	public function isEmpty(): bool {
		return empty($this->shortDescription)
				&& empty($this->longDescription)
				&& $this->tags->size() == 0;
	}

	/**
	 * Returns the string version of the docblock
	 * 
	 * @return string
	 */
	public function toString(): string {
		$docblock = "/**\n";

		// short description
		$short = trim($this->shortDescription);
		if (!empty($short)) {
			$docblock .= $this->writeLines(explode("\n", $short));
		}

		// short description
		$long = trim($this->longDescription);
		if (!empty($long)) {
			$docblock .= $this->writeLines(explode("\n", $long), !empty($short));
		}

		// tags
		$tags = $this->getSortedTags()->map(function (AbstractTag $tag): string {
			return (string) $tag;
		});

		if (!$tags->isEmpty()) {
			$docblock .= $this->writeLines($tags->toArray(), !empty($short) || !empty($long));
		}

		$docblock .= ' */';

		return $docblock;
	}

	/**
	 * Writes multiple lines with ' * ' prefixed for docblock
	 * 
	 * @param string[] $lines the lines to be written
	 * @param bool $newline if a new line should be added before
	 *
	 * @return string the lines as string
	 */
	protected function writeLines(array $lines, bool $newline = false): string {
		$docblock = '';
		if ($newline) {
			$docblock .= " *\n";
		}

		foreach ($lines as $line) {
			if (strpos($line, "\n")) {
				$sublines = explode("\n", $line);
				$line = array_shift($sublines);
				$docblock .= ' * ' . $line . "\n";
				$docblock .= $this->writeLines($sublines);
			} else {
				$docblock .= ' * ' . $line . "\n";
			}
		}

		return $docblock;
	}

	/**
	 * Magic toString() method
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->toString();
	}
}
