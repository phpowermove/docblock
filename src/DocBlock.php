<?php

namespace gossi\docblock;

use gossi\docblock\tags\TagFactory;
use gossi\docblock\tags\AbstractTag;

class DocBlock {
	
	protected $shortDescription;
	protected $longDescription;
	protected $tags;
	
	const REGEX_TAGNAME = '[\w\-\_\\\\]+';
	
	/**
	 * Static docblock factory
	 * 
	 * @param string \Reflector|$docblock
	 * @return $this
	 */
	public static function create($docblock = null) {
		return new static($docblock);
	}
	
	/**
	 * Creates a new docblock instance and parses the initial string or reflector object if given
	 * 
	 * @param \ReflectionFunctionAbstract|\ReflectionClass|\ReflectionProperty|string a docblock to parse
	 */
	public function __construct($docblock = null) {
		$this->parse($docblock);
	}
	
	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 * @param \ReflectionFunctionAbstract|\ReflectionClass|\ReflectionProperty|string $docblock
	 * @throws \InvalidArgumentException if there is no getDocCommect() method available
	 */
	protected function parse($docblock) {
		if (is_object($docblock)) {
			if (!method_exists($docblock, 'getDocComment')) {
				throw new \InvalidArgumentException('Invalid object passed; the given ' .
						'reflector must support the getDocComment method');
			}
		
			$docblock = $docblock->getDocComment();
		}
		
		$docblock = $this->cleanInput($docblock);
		
		list($short, $long, $tags) = $this->splitDocBlock($docblock);
		$this->shortDescription = $short;
		$this->longDescription = $long;
		$this->parseTags($tags);
	}
	
	/**
	 * Strips the asterisks from the DocBlock comment.
	 * 
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock.php Original Method
	 * @param string $comment String containing the comment text.
	 * @return string
	 */
	protected function cleanInput($comment) {
		$comment = trim(preg_replace('#[ \t]*(?:\/\*\*|\*\/|\*)?[ \t]{0,1}(.*)?#u',	'$1', $comment));
	
		// reg ex above is not able to remove */ from a single line docblock
		if (substr($comment, -2) == '*/') {
			$comment = trim(substr($comment, 0, -2));
		}
	
		// normalize strings
		$comment = str_replace(array("\r\n", "\r"), "\n", $comment);
	
		return $comment;
	}
	
	/**
	 * Splits the DocBlock into a short description, long description and
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
	protected function splitDocBlock($comment) {
		$matches = [];
		
		if (strpos($comment, '@') === 0) {
			$matches = array('', '', $comment);
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
	 * @param string $tags
	 * @throws \LogicException
	 * @throws \InvalidArgumentException
	 */
	protected function parseTags($tags) {
		$result = [];
		$tags = trim($tags);
		if ($tags !== '') {
			
			// sanitize lines
			foreach (explode("\n", $tags) as $line) {
				if ($this->isTagLine($line) || count($result) == 0) {
					$result[] = $line;
				} else {
					$result[count($result) - 1] .= PHP_EOL . $line;
				}
			}
		
			// create proper Tag objects
			foreach ($result as $key => $line) {
				$result[$key] = $this->parseTag($line); 
			}
		}
		
		$this->tags = $result;
	}
	
	/**
	 * Checks whether the given line is a tag line (= starts with @) or not
	 * 
	 * @param string $line
	 * @return boolean
	 */
	protected function isTagLine($line) {
		return isset($line[0]) && $line[0] == '@';
	}
	
	/**
	 * Parses an individual tag line
	 * 
	 * @param string $line
	 * @throws \InvalidArgumentException
	 * @return \gossi\docblock\tags\AbstractTag
	 */
	protected function parseTag($line) {
		$matches = [];
		if (!preg_match('/^@(' . self::REGEX_TAGNAME . ')(?:\s*([^\s].*)|$)?/us', $line, $matches)) {
			throw new \InvalidArgumentException('Invalid tag line detected: ' . $line);
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
	public function getShortDescription() {
		return $this->shortDescription;
	}
	
	/**
	 * Sets the short description
	 * 
	 * @param string $description the new description     
	 * @return $this   	
	 */
	public function setShortDescription($description) {
		$this->shortDescription = $description;
		return $this;
	}
	
	/**
	 * Returns the long description
	 *
	 * @return string the long description
	 */
	public function getLongDescription() {
		return $this->longDescription;
	}
	
	/**
	 * Sets the long description
	 * 
	 * @param string $description the new description        	
	 */
	public function setLongDescription($description) {
		$this->longDescription = $description;
		return $this;
	}

	/**
	 * Adds a tag to this docblock
	 * 
	 * @param AbstractTag $tag
	 * @return $this
	 */
	public function appendTag(AbstractTag $tag) {
		$this->tags[] = $tag;
		return $this;
	}
	
	/**
	 * Checks whether a tag is present
	 * 
	 * @param string $tagName
	 * @return boolean
	 */
	public function hasTag($tagName) {
		foreach ($this->tags as $tag) {
			if ($tag->getTagName() == $tagName) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Gets tags (by tag name)
	 * 
	 * @param string $tagName
	 * @return AbstractTag[] the tags
	 */
	public function getTags($tagName = null) {
		$tags = [];
		foreach ($this->tags as $tag) {
			if ($tagName === null || $tag->getTagName() == $tagName) {
				$tags[] = $tag;
			}
		}
		
		return $tags;
	}
	
	/**
	 * Returns the string version of the docblock
	 * 
	 * @return string
	 */
	public function toString() {
		$docblock = "/**\n";
		
		// short description
		$short = trim($this->shortDescription);
		if (!empty($short)) {
			$docblock .= $this->writeLines(explode("\n", wordwrap($short)));
		}
		
		// short description
		$long = trim($this->longDescription);
		if (!empty($long)) {
			$docblock .= $this->writeLines(explode("\n", wordwrap($long)), !empty($short));
		}
		
		// tags
		$tags = [];
		foreach ($this->tags as $tag) {
			$tags[] = $tag->toString();
		}
		
		if (count($tags)) {
			$docblock .= $this->writeLines($tags, !empty($short) || !empty($long));
		}
		
		$docblock .= ' */';
		
		return $docblock;
	}
	
	/**
	 * Writes multiple lines with ' * ' prefixed for docblock
	 * 
	 * @param string[] $lines the lines to be written
	 * @param boolean $newline if a new line should be added before
	 * @return string the lines as string
	 */
	protected function writeLines($lines, $newline = false) {
		$docblock = '';
		if ($newline) {
			$docblock .= " * \n";
		}

		foreach ($lines as $line) {
			$docblock .= ' * ' . $line . "\n";
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