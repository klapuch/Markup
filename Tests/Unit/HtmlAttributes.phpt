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

final class HtmlAttributes extends Tester\TestCase {
	public function testRepetitiveAttributes() {
		Assert::same(
			'type="email" name="surname" class="surname"',
			(new Markup\HtmlAttributes(
				new Markup\FakeAttribute('type="text"'), // repetitive attribute
				new Markup\FakeAttribute('name="surname"'), // repetitive value
				new Markup\FakeAttribute('class="surname"'), // repetitive value
				new Markup\FakeAttribute('type="email"') // repetitive attribute
			))->pairs()
		);
	}

	public function testSeparators() {
		Assert::same(
			'type="text"',
			(new Markup\HtmlAttributes(
				new Markup\FakeAttribute('type="text"')
			))->pairs()
		);
		Assert::same(
			'type="text" name="surname"',
			(new Markup\HtmlAttributes(
				new Markup\FakeAttribute('type="text"'),
				new Markup\FakeAttribute('name="surname"')
			))->pairs()
		);
		Assert::same(
			'type="text" name="surname" required="true"',
			(new Markup\HtmlAttributes(
				new Markup\FakeAttribute('type="text"'),
				new Markup\FakeAttribute('name="surname"'),
				new Markup\FakeAttribute('required="true"')
			))->pairs()
		);
	}
}

(new HtmlAttributes())->run();