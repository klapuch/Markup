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
		Assert::same(
			'<p class="danger">',
			(new Markup\HtmlTag(
				'p',
				new Markup\FakeAttributes('class="danger"')
			))->start()
		);
		Assert::same(
			'</p>',
			(new Markup\HtmlTag(
				'p',
				new Markup\FakeAttributes('class="danger"')
			))->end()
		);
	}

	/**
	 * @dataProvider invalidTags
	 */
	public function testThrowingOnInvalidTags(string $tag) {
		Assert::exception(
			function() use ($tag) {
				(new Markup\HtmlTag(
					$tag,
					new Markup\FakeAttributes('')
				))->start();
			},
			\InvalidArgumentException::class,
			'Empty or numeric start tag is not allowed'
		);
		Assert::exception(
			function() use ($tag) {
				(new Markup\HtmlTag(
					$tag,
					new Markup\FakeAttributes('')
				))->end();
			},
			\InvalidArgumentException::class,
			'Empty or numeric end tag is not allowed'
		);
	}

	public function testNoAttributes() {
		Assert::same(
			'<p>',
			(new Markup\HtmlTag(
				'p',
				new Markup\FakeAttributes('')
			))->start()
		);
		Assert::same(
			'</p>',
			(new Markup\HtmlTag(
				'p',
				new Markup\FakeAttributes('')
			))->end()
		);
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