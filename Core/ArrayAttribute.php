<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Array transformed attributes
 */
final class ArrayAttribute implements Attribute {
	private $attributes;

	public function __construct(array $attributes) {
		$this->attributes = $attributes;
	}

	public function pair(): string {
		return (new ConcatenatedAttribute(
			...array_map(
				function(string $name, string $value): Attribute {
					return new SafeAttribute($name, $value);
				},
				array_keys($this->attributes),
				$this->attributes
			)
		))->pair();
	}
}