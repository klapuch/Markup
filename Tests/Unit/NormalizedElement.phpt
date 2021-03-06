<?php
declare(strict_types = 1);
/**
 * @testCase
 * @phpVersion > 7.1
 */
namespace Klapuch\Markup\Unit;

use Klapuch\Markup;
use Tester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

final class NormalizedElement extends Tester\TestCase {
	public function testPairTagWithAttributes() {
		Assert::same(
			'<p class="danger">Paragraph</p>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('p class="danger"', 'p'),
				new Markup\FakeElement('Paragraph')
			))->markup()
		);
	}

	public function testPairTagWithoutAttributes() {
		Assert::same(
			'<p>Paragraph</p>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('p', 'p'),
				new Markup\FakeElement('Paragraph')
			))->markup()
		);
	}

	public function testNormalizedWithinNamespace() {
		Assert::same(
			'<xsl:attribute>Paragraph</xsl:attribute>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('xsl:attribute', 'xsl:attribute'),
				new Markup\FakeElement('Paragraph')
			))->markup()
		);
	}

	public function testNormalizedXslDeclaration() {
		Assert::same(
			'<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"><xsl:element name="foo"/></xsl:stylesheet>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"', 'xsl:stylesheet'),
				new Markup\FakeElement('<xsl:element name="foo"/>')
			))->markup()
		);
	}

	public function testNestedElement() {
		Assert::same(
			'<p><em>foo</em></p>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('p', 'p'),
				new Markup\FakeElement('<em>foo</em>')
			))->markup()
		);
	}

	public function testNormalizedNestedElement() {
		Assert::same(
			'<p><em/></p>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('p', 'p'),
				new Markup\FakeElement('<em></em>')
			))->markup()
		);
	}

	public function testEmptyTagWithoutAttributes() {
		Assert::same(
			'<hr/>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('hr', 'hr'),
				new Markup\FakeElement('')
			))->markup()
		);
	}

	public function testEmptyTagWithAttributes() {
		Assert::same(
			'<hr class="cool"/>',
			(new Markup\NormalizedElement(
				new Markup\FakeTag('hr class="cool"', 'hr'),
				new Markup\FakeElement('')
			))->markup()
		);
	}

	public function testValidXml() {
		Assert::noError(
			function() {
				new \SimpleXMLElement(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p class="danger"', 'p'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				new \SimpleXMLElement(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p', 'p'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				new \SimpleXMLElement(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p', 'p'),
						new Markup\FakeElement('')
					))->markup()
				);
			}
		);
	}

	public function testValidHtml() {
		Assert::noError(
			function() {
				$dom = new \DOMDocument();
				$dom->loadHTML(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p class="danger"', 'p'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				$dom->loadHTML(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p', 'p'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				$dom->loadHTML(
					(new Markup\NormalizedElement(
						new Markup\FakeTag('p', 'p'),
						new Markup\FakeElement('')
					))->markup()
				);
			}
		);
	}
}

(new NormalizedElement())->run();