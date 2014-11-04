<?php
namespace gossi\docblock\tags;

/**
 * Represents a @license tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/license.html
 */
class LicenseTag extends AbstractTag {
	
	private $url;
	private $license;
	
	/**
	 * Creates a new tag
	 * 
	 * @param string $tagName the tag name
	 * @param string $content the tags content
	 */
	public function __construct($content = '') {
		parent::__construct('license', $content);
	}
	
	protected function parse($content) {
		$parts = preg_split('/\s+/Su', $content, 2);
	
		$urlCandidate = $parts[0];
		if (preg_match(LinkTag::URL_REGEX, $urlCandidate)) {
			$this->url = $urlCandidate;
			$this->license = isset($parts[1]) ? $parts[1] : '';
		} else {
			$this->license = $content;
		}
	}
	
	/**
	 * Returns the url
	 *
	 * @return string the url
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * Sets the url
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	
	/**
	 * Returns the license
	 * 
	 * @return string
	 */
	public function getLicense() {
		return $this->license;
	}
	
	/**
	 * Sets the license
	 * 
	 * @param string $license
	 * @return $this        	
	 */
	public function setLicense($license) {
		$this->license = $license;
		return $this;
	}
	
	public function toString() {
		return sprintf('@license %s', trim($this->url . ' ' . $this->license));
	}
	
}
