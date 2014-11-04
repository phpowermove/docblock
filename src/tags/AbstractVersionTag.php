<?php
namespace gossi\docblock\tags;

/**
 * Represents tags which are in the format
 *   @tag [Version] [Description]
 */
abstract class AbstractVersionTag extends AbstractDescriptionTag {
	
	/**
	 * PCRE regular expression matching a version vector.
	 * Assumes the "x" modifier.
	 */
	const REGEX_VECTOR = '(?:
        # Normal release vectors.
        \d\S*
        |
        # VCS version vectors. Per PHPCS, they are expected to
        # follow the form of the VCS name, followed by ":", followed
        # by the version vector itself.
        # By convention, popular VCSes like CVS, SVN and GIT use "$"
        # around the actual version vector.
        [^\s\:]+\:\s*\$[^\$]+\$
    )';
	
	protected $version;
	
	/**
	 * @see https://github.com/phpDocumentor/ReflectionDocBlock/blob/master/src/phpDocumentor/Reflection/DocBlock/Tag/VersionTag.php Original Method: setContent()
	 * @see \gossi\docblock\tags\AbstractTag::parse()
	 */
	protected function parse($content) {
		$matches = [];
		if (preg_match(
	            '/^
	                # The version vector
	                (' . self::REGEX_VECTOR . ')
	                \s*
	                # The description
	                (.+)?
	            $/sux',
	            $content,
	            $matches)) {
            $this->version = $matches[1];
            $this->setDescription(isset($matches[2]) ? $matches[2] : '');
        }
	}
	
	public function toString() {
		return trim(sprintf('@%s %s %s', $this->tagName, $this->version, $this->description));
	}
	
	/**
	 * Returns the version
	 * 
	 * @return string the version
	 */
	public function getVersion() {
		return $this->version;
	}
	
	/**
	 * Sets the version
	 * 
	 * @param string $version the new version 
	 * @return $this       	
	 */
	public function setVersion($version) {
		$this->version = $version;
		return $this;
	}	
	
}
