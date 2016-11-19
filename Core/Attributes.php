<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

interface Attributes {
	/**
	 * Name-value pairs
	 * @return string
	 */
	public function pairs(): string;
}