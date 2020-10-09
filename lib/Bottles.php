<?php

declare(strict_types = 1);

class Bottles {
  public function song(): string {
    return $this->verses(99, 0);
  }

  public function verses(int $upper, int $lower): string {
    return implode(
      "\n",
      array_map([$this, 'verse'], range($upper, $lower))
    );
  }

  public function verse(int $number): string {
    $bottleNumber = new BottleNumber($number);
    $nextBottleNumber = new BottleNumber($bottleNumber->successor());

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$nextBottleNumber} of beer on the wall.\n";
  }
}

class BottleNumber {
  protected $number;

  public function __construct(int $number) {
    $this->number = $number;
  }

  public function __toString(): string {
    return $this->quantity() . " " . $this->container();
  }

  public function quantity(): string {
    if ($this->number === 0) {
      return "no more";
    } else {
      return (string)$this->number;
    }
  }

  public function container(): string {
    if ($this->number === 1) {
      return "bottle";
    } else {
      return "bottles";
    }
  }

  public function action(): string {
    if ($this->number === 0) {
      return "Go to the store and buy some more";
    } else {
      return "Take " . $this->pronoun() . " down and pass it around";
    }
  }

  public function pronoun(): string {
    if ($this->number === 1) {
      return "it";
    } else {
      return "one";
    }
  }

  public function successor(): int {
    if ($this->number === 0) {
      return 99;
    } else {
      return $this->number - 1;
    }
  }
}

class BottleNumber0 extends BottleNumber {
  public function quantity(): string {
    if ($this->number === 0) {
      return "no more";
    } else {
      return (string)$this->number;
    }
  }
}
