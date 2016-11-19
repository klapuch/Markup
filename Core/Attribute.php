<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

interface Attribute {
	/**
	 * Name-value pair
	 * @return string
	 */
	public function pair(): string;
}