<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Attributes in a HTML format
 */
final class HtmlAttributes implements Attributes {
	private const EMPTY_PAIRS = [];
	private const SEPARATOR = ' ';
	private $attributes;

	public function __construct(Attribute ...$attributes) {
		$this->attributes = $attributes;
	}

	public function pairs(): string {
		return implode(
			self::SEPARATOR,
			array_map(
				function(Attribute $attribute): string {
					return $attribute->pair();
				},
				array_reduce(
					$this->attributes,
					function(array $pairs, Attribute $attribute): array {
						[$name] = explode('=', $attribute->pair());
						$pairs[$name] = $attribute;
						return $pairs;
					},
					self::EMPTY_PAIRS
				)
			)
		);
	}
}