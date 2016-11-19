<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Fake
 */
final class FakeAttributes implements Attributes {
	private $attributes;

	public function __construct(string $attributes = null) {
		$this->attributes = $attributes;
	}

	public function pairs(): string {
		return $this->attributes;
	}
}