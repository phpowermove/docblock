<?php
namespace gossi\docblock\tags;

/**
 * Represents the @author tag.
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
	 *
	 * @return the string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 *
	 * @param string $name
	 * @return $this     	
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param string $email
	 * @return $this         	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
}
