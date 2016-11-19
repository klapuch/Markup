<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Empty element considered as a null object
 * Suitable as a close part of endless chain
 */
final class EmptyElement implements Element {
	private const EMPTY_ELEMENT = '';

	public function markup(): string {
		return self::EMPTY_ELEMENT;
	}
}