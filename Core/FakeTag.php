<?php
declare(strict_types = 1);
namespace Klapuch\Markup;

final class FakeTag implements Tag {
	private $start;
	private $end;

	public function __construct(string $start, string $end) {
		$this->start = $start;
		$this->end = $end;
	}

	public function start(): string {
		return '<' . $this->start . '>';
	}

	public function end(): string {
		return '</' . $this->end . '>';
	}
}