<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

interface Tag {
	/**
	 * Start of the tag
	 * @return string
	 */
	public function start(): string;

	/**
	 * End of the tag
	 * @return string
	 */
	public function end(): string;
}