<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

interface Element {
	/**
	 * Markup of the element
	 * @return string
	 */
	public function markup(): string;
}