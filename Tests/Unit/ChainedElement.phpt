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
}

(new ChainedElement())->run();