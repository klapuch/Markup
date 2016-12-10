<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Attribute in a HTML format
 */
final class HtmlAttribute implements Attribute {
	private const INVALID_ATTRIBUTE = '';
	private $attribute;
	private $value;

	public function __construct(string $attribute, string $value) {
		$this->attribute = $attribute;
		$this->value = $value;
	}

	public function pair(): string {
		if($this->omitted($this->attribute) || $this->omitted($this->value))
			return self::INVALID_ATTRIBUTE;
		return sprintf(
			'%s="%s"',
			mb_strtolower($this->attribute),
			htmlspecialchars($this->value, ENT_QUOTES | ENT_XHTML)
		);
	}

	/**
	 * Is the value omitted?
	 * @param string $value
	 * @return bool
	 */
	private function omitted(string $value): bool {
		return strlen(trim($value)) === 0;
	}
}