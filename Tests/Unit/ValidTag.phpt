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

final class ValidTag extends Tester\TestCase {
	public function testPassingOnInvolvedAttributes() {
		$tag = new Markup\ValidTag('p', new Markup\FakeAttribute('class="danger"'));
		Assert::same('<p class="danger">', $tag->start());
		Assert::same('</p>', $tag->end());
	}

	public function testPassingOnNamespaceTag() {
		$tag = new Markup\ValidTag(
			'xsl:value-of',
			new Markup\FakeAttribute('select="//p"')
		);
		Assert::same('<xsl:value-of select="//p">', $tag->start());
		Assert::same('</xsl:value-of>', $tag->end());
	}

	/**
	 * @dataProvider invalidTags
	 */
	public function testThrowingOnInvalidTags(string $name) {
		$tag = new Markup\ValidTag($name, new Markup\FakeAttribute(''));
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

	public function testPassingNoAttributes() {
		$tag = new Markup\ValidTag('p', new Markup\FakeAttribute(''));
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

(new ValidTag())->run();