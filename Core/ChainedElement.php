<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Chained element behaving as a single one
 */
final class ChainedElement implements Element {
	private const EMPTY_ELEMENT = '';
	private $elements;

	public function __construct(Element ...$elements) {
		$this->elements = $elements;
	}

	public function markup(): string {
		return array_reduce(
			$this->elements,
			function(string $elements, Element $element): string {
				return $elements .= $element->markup();
			},
			self::EMPTY_ELEMENT
		);
	}
}