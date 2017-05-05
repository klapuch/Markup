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

final class SafeElement extends Tester\TestCase {
	public function testEnabledXSSProtection() {
		Assert::same(
			'&lt;&quot;&amp;&apos;&gt;',
			(new Markup\SafeElement('<"&\'>'))->markup()
		);
	}
}

(new SafeElement())->run();