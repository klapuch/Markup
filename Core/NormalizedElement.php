<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Normalized element in sense of <p></p> becomes </p>
 */
final class NormalizedElement implements Element {
	private $tag;
	private $children;

	public function __construct(Tag $tag, Element $children) {
		$this->tag = $tag;
		$this->children = $children;
	}

	public function markup(): string {
		return trim(
			$this->withoutDeclaration(
				@(new \SimpleXMLElement(
					$this->tag->start()
					. $this->children->markup()
					. $this->tag->end()
				))->asXML()
			)
		);
	}

	/**
	 * XML string without declaration <?xml ... ?>
	 * @param string $xml
	 * @return string
	 */
	private function withoutDeclaration(string $xml): string {
		return substr($xml, strpos($xml, '?>') + 2);
	}
}