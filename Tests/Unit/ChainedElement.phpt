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

final class ChainedElement extends Tester\TestCase {
	public function testChainingInGivenOrder() {
		Assert::same(
			'abc',
			(new Markup\ChainedElement(
				new Markup\FakeElement('a'),
				new Markup\FakeElement('b'),
				new Markup\FakeElement('c')
			))->markup()
		);
	}

	public function testAllowingDuplication() {
		Assert::same(
			'abbcc',
			(new Markup\ChainedElement(
				new Markup\FakeElement('a'),
				new Markup\FakeElement('b'),
				new Markup\FakeElement('b'),
				new Markup\FakeElement('c'),
				new Markup\FakeElement('c')
			))->markup()
		);
	}
}

(new ChainedElement())->run();