<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Element containing only text
 */
final class TextElement implements Element {
	private $content;

	public function __construct(string $content) {
		$this->content = $content;
	}

	public function markup(): string {
		return strip_tags($this->content);
	}
}