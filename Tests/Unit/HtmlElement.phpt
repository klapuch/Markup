<?php
/**
 * @testCase
 * @phpVersion > 7.1
 */
namespace Klapuch\Markup\Unit;

use Klapuch\Markup;
use Tester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

final class HtmlElement extends Tester\TestCase {
	public function testPairTagWithAttributes() {
		Assert::same(
			'<p class="danger">Paragraph</p>',
			(new Markup\HtmlElement(
				'p',
				new Markup\FakeAttributes('class="danger"'),
				new Markup\FakeElement('Paragraph')
			))->markup()
		);
	}

	/**
	 * @dataProvider emptyTags
	 */
	public function testEmptyTag(string $tag) {
		Assert::same(
			'',
			(new Markup\HtmlElement(
				$tag,
				new Markup\FakeAttributes(''),
				new Markup\FakeElement('')
			))->markup()
		);
	}

	protected function emptyTags() {
		return [
			[''],
			['	'],
			[' '],
			['0'], // tag can't be numeric
		];
	}

	public function testPairTagWithoutAttributes() {
		Assert::same(
			'<p>Paragraph</p>',
			(new Markup\HtmlElement(
				'p',
				new Markup\FakeAttributes(''),
				new Markup\FakeElement('Paragraph')
			))->markup()
		);
	}

	public function testSingleTagWithoutAttributes() {
		Assert::same(
			'<hr/>',
			(new Markup\HtmlElement(
				'hr',
				new Markup\FakeAttributes(''),
				new Markup\FakeElement('')
			))->markup()
		);
	}

	public function testSingleTagWithAttributes() {
		Assert::same(
			'<hr class="cool"/>',
			(new Markup\HtmlElement(
				'hr',
				new Markup\FakeAttributes('class="cool"'),
				new Markup\FakeElement('')
			))->markup()
		);
	}

	public function testValidXml() {
		Assert::noError(
			function() {
				new \SimpleXMLElement(
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes('class="danger"'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				new \SimpleXMLElement(
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes(''),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				new \SimpleXMLElement(
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes(''),
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
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes('class="danger"'),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				$dom->loadHTML(
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes(''),
						new Markup\FakeElement('Paragraph')
					))->markup()
				);
				$dom->loadHTML(
					(new Markup\HtmlElement(
						'p',
						new Markup\FakeAttributes(''),
						new Markup\FakeElement('')
					))->markup()
				);
			}
		);
	}
}

(new HtmlElement())->run();