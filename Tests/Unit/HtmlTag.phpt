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

final class HtmlTag extends Tester\TestCase {
	public function testInvolvedAttributes() {
		$tag = new Markup\HtmlTag('p', new Markup\FakeAttributes('class="danger"'));
		Assert::same('<p class="danger">', $tag->start());
		Assert::same('</p>', $tag->end());
	}

	public function testXmlTag() {
		$tag = new Markup\HtmlTag(
			'xsl:value-of',
			new Markup\FakeAttributes('select="//p"')
		);
		Assert::same('<xsl:value-of select="//p">', $tag->start());
		Assert::same('</xsl:value-of>', $tag->end());
	}

	/**
	 * @dataProvider invalidTags
	 */
	public function testThrowingOnInvalidTags(string $name) {
		$tag = new Markup\HtmlTag($name, new Markup\FakeAttributes(''));
		Assert::exception(
			function() use ($tag) {
				$tag->start();
			},
			\InvalidArgumentException::class,
			'Empty or numeric start tag is not allowed'
		);
		Assert::exception(
			function() use ($tag) {
				$tag->end();
			},
			\InvalidArgumentException::class,
			'Empty or numeric end tag is not allowed'
		);
	}

	public function testNoAttributes() {
		$tag = new Markup\HtmlTag('p', new Markup\FakeAttributes(''));
		Assert::same('<p>', $tag->start());
		Assert::same('</p>', $tag->end());
	}

	protected function invalidTags() {
		return [
			[''],
			['	'],
			[' '],
			['0'], // empty and numeric tag
			['6'], // numeric tag
		];
	}
}

(new HtmlTag())->run();