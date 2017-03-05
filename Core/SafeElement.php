<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * XSS-proof element
 */
final class SafeElement implements Element {
	private $content;

	public function __construct(string $content) {
		$this->content = $content;
	}

	public function markup(): string {
		return htmlspecialchars($this->content, ENT_QUOTES | ENT_XHTML);
	}
}