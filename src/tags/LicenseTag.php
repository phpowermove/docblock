<?php declare(strict_types=1);

namespace gossi\docblock\tags;

/**
 * Represents a @license tag.
 * 
 * @see http://www.phpdoc.org/docs/latest/references/phpdoc/tags/license.html
 */
class LicenseTag extends AbstractTag {

	/** @var  string */
	private $url = '';

	/** @var string */
	private $license = '';

	/**
	 * Creates a new tag
	 * 
	 * @param string $content the tags content
	 */
	public function __construct(string $content = '') {
		parent::__construct('license', $content);
	}

	protected function parse(string $content): void {
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
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param string $url
	 *
	 * @return $this
	 */
	public function setUrl(string $url): self {
		$this->url = $url;

		return $this;
	}

	/**
	 * Returns the license
	 * 
	 * @return string
	 */
	public function getLicense(): string {
		return $this->license;
	}

	/**
	 * Sets the license
	 * 
	 * @param string $license
	 *
	 * @return $this        	
	 */
	public function setLicense(string $license): self {
		$this->license = $license;

		return $this;
	}

	public function toString(): string {
		return sprintf('@license %s', trim($this->url . ' ' . $this->license));
	}
}
