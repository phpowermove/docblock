<?php
namespace gossi\docblock\tags;

/**
 * Represents the @author tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/author.html
 */
class AuthorTag extends AbstractTag {
	
	/**
	 * PCRE regular expression matching any valid value for the name component.
	 */
	const REGEX_AUTHOR_NAME = '[^\<]*';
	
	/**
	 * PCRE regular expression matching any valid value for the email component.
	 */
	const REGEX_AUTHOR_EMAIL = '[^\>]*';
	
	protected $name;
	protected $email;
	
	public function __construct($content = '') {
		parent::__construct('author', $content);
	}
	
	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock/Tag/AuthorTag.php Original Method: setContent()
	 * @see \gossi\docblock\tags\AbstractTag::parse()
	 */
	protected function parse($content) {
		$matches = [];
		if (preg_match('/^(' . self::REGEX_AUTHOR_NAME . ')(\<(' . self::REGEX_AUTHOR_EMAIL . ')\>)?$/u',
				$content, $matches)) {
			$this->name = trim($matches[1]);
			if (isset($matches[3])) {
				$this->email = trim($matches[3]);
			}
		}
	}
	
	public function toString() {
		$email = !empty($this->email) ? '<' . $this->email . '>' : '';
		return trim(sprintf('@author %s %s', $this->name, $email));
	}
	
	/**
	 * Returns the authors name
	 * 
	 * @return string the authors name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Sets the authors name
	 *
	 * @param string $name the new name
	 * @return $this     	
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 * Returns the authors email
	 * 
	 * @return string the authors email
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Sets the authors email
	 * 
	 * @param string $email the new email
	 * @return $this         	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
}
