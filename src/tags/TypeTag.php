<?php
namespace gossi\docblock\tags;

/**
 * Represents @type tag.
 * 
 * The format is:
 *   @tag [Type] [Variable] [Description]
 */
class TypeTag extends AbstractTypeTag {
	
	protected $variable;
	protected $isVariadic;

	public function __construct($content = '') {
		parent::__construct('type', $content);
	}
	
	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock/Tag/ParamTag.php Original Method: setContent()
	 * @see \gossi\docblock\tags\AbstractTypeTag::parse()
	 */
	protected function parse($content) {
		$parts = preg_split('/(\s+)/Su', $content, 3, PREG_SPLIT_DELIM_CAPTURE);
		
		// if the first item that is encountered is not a variable; it is a type
		if (isset($parts[0])
				&& (strlen($parts[0]) > 0)
				&& ($parts[0][0] !== '$')
				&& substr($parts[0], 0, 4) !== '...$') {
			$this->type = array_shift($parts);
			array_shift($parts);
		}
		
		// if the next item starts with a $ or ...$ it must be the variable name
		if (isset($parts[0])
				&& (strlen($parts[0]) > 0)
				&& ($parts[0][0] == '$' || substr($parts[0], 0, 4) === '...$')) {
			$this->variable = array_shift($parts);
			array_shift($parts);

			if (substr($this->variable, 0, 3) === '...') {
				$this->isVariadic = true;
				$this->variable = substr($this->variable, 3);
			}
		}

		$this->setDescription(implode('', $parts));
	}
	
	public function toString() {
		$type = !empty($this->type) ? $this->type . ' ' : '';
		$var = !empty($this->variable)
			? ($this->isVariadic ?: '...') . $this->variable . ' ' : ''; 
		return trim(sprintf('@%s %s%s%s', $this->tagName, $type, $var, $this->description));
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getVariable() {
		return $this->variable;
	}
	
	/**
	 *
	 * @param string $variable
	 * @return $this        	
	 */
	public function setVariable($variable) {
		$this->variable = $variable;
		return $this;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function isVariadic() {
		return $this->isVariadic;
	}
	
	/**
	 *
	 * @param boolean $isVariadic
	 * @return $this        	
	 */
	public function setVariadic($variadic) {
		$this->isVariadic = $variadic;
		return $this;
	}

}
