<?php
namespace gossi\docblock\tags;

/**
 * Represents tags which are in the format
 *   @tag [Type] [Variable] [Description]
 */
abstract class AbstractVarTypeTag extends AbstractTypeTag {

	protected $variable;
	protected $isVariadic = false;

	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock/Tag/ParamTag.php Original Method: setContent()
	 * @see \gossi\docblock\tags\AbstractTypeTag::parse()
	 */
	protected function parse($content) {
		$parts = preg_split('/(\s+)/Su', $content, 3, PREG_SPLIT_DELIM_CAPTURE);
		
		$this->parseType($parts);
		$this->parseVariable($parts);
		$this->setDescription(implode('', $parts));
	}
	
	/**
	 * Parses the type from the extracted parts
	 * 
	 * @param array $parts
	 * @return array the remaining parts
	 */
	private function parseType(&$parts) {
		// if the first item that is encountered is not a variable; it is a type
		if (isset($parts[0])
				&& (strlen($parts[0]) > 0)
				&& ($parts[0][0] !== '$')
				&& substr($parts[0], 0, 4) !== '...$') {
					$this->type = array_shift($parts);
			array_shift($parts);
		}
	}
	
	/**
	 * Parses the variable from the extracted parts
	 *
	 * @param array $parts
	 * @return array the remaining parts
	 */
	private function parseVariable(&$parts) {
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
	}
	
	public function toString() {
		$type = !empty($this->type) ? $this->type . ' ' : '';
		$var = !empty($this->variable)
			? ($this->isVariadic ? '...' : '') . $this->variable . ' ' : ''; 
		return trim(sprintf('@%s %s%s%s', $this->tagName, $type, $var, $this->description));
	}
	
	/**
	 * Returnst the variable
	 * 
	 * @return string the variable name
	 */
	public function getVariable() {
		return $this->variable;
	}
	
	/**
	 * Sets the variable
	 *
	 * @param string $variable the new variable name
	 * @return $this        	
	 */
	public function setVariable($variable) {
		if ($variable[0] !== '$') {
			$variable = '$' . $variable;
		}
		$this->variable = $variable;
		return $this;
	}
	
	/**
	 * Returns if the variable is variadic
	 * 
	 * @return boolean if the variable is variadic
	 */
	public function isVariadic() {
		return $this->isVariadic;
	}
	
	/**
	 * Sets whether the variable should be variadic
	 * 
	 * @param boolean $variadic
	 * @return $this        	
	 */
	public function setVariadic($variadic) {
		$this->isVariadic = $variadic;
		return $this;
	}
	
}
