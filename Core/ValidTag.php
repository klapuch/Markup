<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Valid XML, HTML tag
 */
final class ValidTag implements Tag {
	private $name;
	private $attribute;

	public function __construct(string $name, Attribute $attribute) {
		$this->name = $name;
		$this->attribute = $attribute;
	}

	public function start(): string {
		if(!$this->valid($this->name)) {
			throw new \InvalidArgumentException(
				'Empty or numeric start tag is not allowed'
			);
		}
		return sprintf(
			'<%s>',
			$this->name . $this->withSpace($this->attribute->pair())
		);
	}

	public function end(): string {
		if(!$this->valid($this->name)) {
			throw new \InvalidArgumentException(
				'Empty or numeric end tag is not allowed'
			);
		}
		return sprintf('</%s>', $this->name);
	}

	/**
	 * Is the tag name valid?
	 * @param string $name
	 * @return bool
	 */
	private function valid(string $name): bool {
		return trim($name) && !is_numeric($name);
	}

	/**
	 * Prepended space to the given value
	 * @return string
	 */
	private function withSpace(string $value): string {
		return str_repeat(' ', $value ? 1 : 0) . $value;
	}
}