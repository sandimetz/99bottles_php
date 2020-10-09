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
    $bottleNumber = BottleNumber::for($number);

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$bottleNumber->successor()} of beer on the wall.\n";
  }
}

class BottleNumber {
  protected $number;

  public static function for(int $number): BottleNumber {
    switch ($number) {
    case 0:
      $className = BottleNumber0::class;
      break;
    case 1:
      $className = BottleNumber1::class;
      break;
    default:
      $className = BottleNumber::class;
      break;
    }
    return new $className($number);
  }

  public function __construct(int $number) {
    $this->number = $number;
  }

  public function __toString(): string {
    return $this->quantity() . " " . $this->container();
  }

  public function quantity(): string {
    return (string)$this->number;
  }

  public function container(): string {
    return "bottles";
  }

  public function action(): string {
    return "Take " . $this->pronoun() . " down and pass it around";
  }

  public function pronoun(): string {
    return "one";
  }

  public function successor() {
    return BottleNumber::for($this->number - 1);
  }
}

class BottleNumber0 extends BottleNumber {
  public function quantity(): string {
    return "no more";
  }

  public function action(): string {
    return "Go to the store and buy some more";
  }

  public function successor() {
    return BottleNumber::for(99);
  }
}

class BottleNumber1 extends BottleNumber {
  public function container(): string {
    return "bottle";
  }

  public function pronoun(): string {
    return "it";
  }
}
