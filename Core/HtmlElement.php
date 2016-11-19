<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

/**
 * Element in a HTML format
 */
final class HtmlElement implements Element {
	private $tag;
	private $attributes;
	private $children;

	public function __construct(
		string $tag,
		Attributes $attributes,
		Element $children
	) {
		$this->tag = $tag;
		$this->attributes = $attributes;
		$this->children = $children;
	}

	public function markup(): string {
		return trim(
			$this->withoutDeclaration(
				(new \SimpleXMLElement(
					sprintf(
						'<%1$s %2$s>%3$s</%1$s>',
						$this->tag,
						$this->attributes->pairs(),
						$this->children->markup()
					)
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