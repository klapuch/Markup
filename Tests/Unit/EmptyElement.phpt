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

final class EmptyElement extends Tester\TestCase {
	public function testEmptyElement() {
		Assert::same('', (new Markup\EmptyElement())->markup());
	}
}

(new EmptyElement())->run();