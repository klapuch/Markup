<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Fake
 */
final class FakeAttribute implements Attribute {
	private $pair;

	public function __construct(string $pair = null) {
		$this->pair = $pair;
	}

	public function pair(): string {
		return $this->pair;
	}
}