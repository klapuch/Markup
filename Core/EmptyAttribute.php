<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Empty attribute considered as a null object
 * Suitable as a close part of endless chain
 */
final class EmptyAttribute implements Attribute {
	private const EMPTY_ATTRIBUTE = '';

	public function pair(): string {
		return self::EMPTY_ATTRIBUTE;
	}
}