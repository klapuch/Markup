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

final class ConcatenatedAttribute extends Tester\TestCase {
	public function testMatchingLastDuplication() {
		Assert::same(
			'type="email" name="surname" class="surname"',
			(new Markup\ConcatenatedAttribute(
				new Markup\FakeAttribute('type="text"'), // repetitive attribute
				new Markup\FakeAttribute('name="surname"'), // repetitive value
				new Markup\FakeAttribute('class="surname"'), // repetitive value
				new Markup\FakeAttribute('type="number"'), // repetitive attribute
				new Markup\FakeAttribute('type="email"') // repetitive attribute
			))->pair()
		);
	}

	public function testSeparators() {
		Assert::same(
			'type="text"',
			(new Markup\ConcatenatedAttribute(
				new Markup\FakeAttribute('type="text"')
			))->pair()
		);
		Assert::same(
			'type="text" name="surname"',
			(new Markup\ConcatenatedAttribute(
				new Markup\FakeAttribute('type="text"'),
				new Markup\FakeAttribute('name="surname"')
			))->pair()
		);
		Assert::same(
			'type="text" name="surname" required="true" nested="foo=bar"',
			(new Markup\ConcatenatedAttribute(
				new Markup\FakeAttribute('type="text"'),
				new Markup\FakeAttribute('name="surname"'),
				new Markup\FakeAttribute('required="true"'),
				new Markup\FakeAttribute('nested="foo=bar"')
			))->pair()
		);
	}
}

(new ConcatenatedAttribute())->run();