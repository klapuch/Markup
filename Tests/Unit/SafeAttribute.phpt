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

final class SafeAttribute extends Tester\TestCase {
	public function testPassedValidAttribute() {
		Assert::same(
			'type="text"',
			(new Markup\SafeAttribute('type', 'text'))->pair()
		);
	}

	public function testNameAsPartOfNamespace() {
		Assert::same(
			'xmlns:xsl="http://www.w3.org/1999/XSL/Transform"',
			(new Markup\SafeAttribute('xmlns:xsl', 'http://www.w3.org/1999/XSL/Transform'))->pair()
		);
	}

	public function testPassedUnknownAttribute() {
		Assert::same(
			'foo="bar"',
			(new Markup\SafeAttribute('foo', 'bar'))->pair()
		);
	}

	public function testUnitedAttributeName() {
		Assert::same(
			'kůň_hihi="bar"',
			(new Markup\SafeAttribute('KŮŇ_Hihi', 'bar'))->pair()
		);
	}

	/**
	 * @dataProvider emptyAttributes
	 */
	public function testEmptyAttributes(string $attribute, string $value) {
		Assert::same(
			'',
			(new Markup\SafeAttribute($attribute, $value))->pair()
		);
	}

	public function testPassedNumericAttribute() {
		Assert::same(
			'0="foo"',
			(new Markup\SafeAttribute('0', 'foo'))->pair()
		);
	}

	public function testPassedNumericValueAttribute() {
		Assert::same(
			'foo="0"',
			(new Markup\SafeAttribute('foo', '0'))->pair()
		);
	}

	public function testEnabledXSSProtectionForValue() {
		Assert::same(
			'foo="&lt;&quot;&amp;&apos;&gt;"',
			(new Markup\SafeAttribute('foo', '<"&\'>'))->pair()
		);
	}

	public function testDisabledXSSProtectionForName() {
		Assert::same(
			'<>="foo"',
			(new Markup\SafeAttribute('<>', 'foo'))->pair()
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

(new SafeAttribute())->run();