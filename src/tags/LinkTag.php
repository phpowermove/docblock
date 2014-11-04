<?php

namespace gossi\docblock\tags;

use gossi\docblock\tags\AbstractDescriptionTag;

/**
 * Represents a @link tag
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/link.html
 */
class LinkTag extends AbstractDescriptionTag {

	private $url;
	
	public function __construct($content = '') {
		parent::__construct('link', $content);
	}
	
	/**
	 * Url Regex by @diegoperini
	 * 
	 * @see https://mathiasbynens.be/demo/url-regex
	 * @var string
	 */
	const URL_REGEX = '_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS';
	
	protected function parse($content) {
		$parts = preg_split('/\s+/Su', $content, 2);
		
		$urlCandidate = $parts[0];
		if (preg_match(self::URL_REGEX, $urlCandidate)) {
			$this->url = $urlCandidate;
			$this->setDescription(isset($parts[1]) ? $parts[1] : '');
		} else {
			$this->setDescription($content);
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
	
	public function toString() {
		return trim(sprintf('@link %s', trim($this->url . ' ' . $this->description)));
	}
}
