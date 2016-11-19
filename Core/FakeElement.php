<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Fake
 */
final class FakeElement implements Element {
	private $markup;

	public function __construct(string $markup = null) {
		$this->markup = $markup;
	}

	public function markup(): string {
		return $this->markup;
	}
}