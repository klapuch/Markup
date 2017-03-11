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

final class ArrayAttribute extends Tester\TestCase {
	public function testKeyValueArrayPair() {
		Assert::same(
			'type="text" name="firstname"',
			(new Markup\ArrayAttribute(
				['type' => 'text', 'name' => 'firstname']
			))->pair()
		);
	}

	public function testXssProofValue() {
		Assert::same(
			'type="&lt;&quot;&amp;&gt;"',
			(new Markup\ArrayAttribute(['type' => '<"&>']))->pair()
		);
	}
}

(new ArrayAttribute())->run();