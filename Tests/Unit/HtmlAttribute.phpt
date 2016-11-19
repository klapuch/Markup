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

final class HtmlAttribute extends Tester\TestCase {
	public function testPassedValidAttribute() {
		Assert::same(
			'type="text"',
			(new Markup\HtmlAttribute('type', 'text'))->pair()
		);
	}

	public function testPassedInvalidAttribute() {
		Assert::same(
			'foo="bar"',
			(new Markup\HtmlAttribute('foo', 'bar'))->pair()
		);
	}

	/**
	 * @dataProvider emptyAttributes
	 */
	public function testEmptyAttributes(string $attribute, string $value) {
		Assert::same('', (new Markup\HtmlAttribute($attribute, $value))->pair());
	}

	public function testPassedNumericAttribute() {
		Assert::same(
			'0="foo"',
			(new Markup\HtmlAttribute('0', 'foo'))->pair()
		);
	}

	public function testPassedNumericValueAttribute() {
		Assert::same(
			'foo="0"',
			(new Markup\HtmlAttribute('foo', '0'))->pair()
		);
	}

	protected function emptyAttributes() {
		return [
			['attribute', ''],
			['attribute', ' '],
			['attribute', '	'],
			['attribute', false],
			['', 'value'],
			[' ', 'value'],
			['	', 'value'],
			[false, 'value'],
		];
	}
}

(new HtmlAttribute())->run();