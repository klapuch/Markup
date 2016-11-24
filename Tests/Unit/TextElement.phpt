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

final class TextElement extends Tester\TestCase {
	public function testElementContainingOnlyText() {
		Assert::same(
			'Cool',
			(new Markup\TextElement('<p class="danger"><p>Cool</p>'))->markup()
		);
	}
}

(new TextElement())->run();