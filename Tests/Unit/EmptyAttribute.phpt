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

final class EmptyAttribute extends Tester\TestCase {
	public function testEmptyElement() {
		Assert::same('', (new Markup\EmptyAttribute())->pair());
	}
}

(new EmptyAttribute())->run();