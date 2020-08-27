<?php

declare(strict_types = 1);

class Bottles {
  public function song() {
    return $this->verses(99, 0);
  }

  public function verses($upper, $lower) {
    $verses = [];
    foreach (range($upper, $lower) as $i) {
      $verses[] = $this->verse($i);
    }

    return implode("\n", $verses);
  }

  public function verse($number) {
    $bottleNumber = BottleNumber::for($number);

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$bottleNumber->successor()} of beer on the wall.\n";
  }
}

class BottleNumber {
  protected static $registry = [];
  protected $number;

  public static function register($candidate) {
    array_unshift(self::$registry, $candidate);
  }

  public static function for($number) {
    foreach (self::$registry as $candidate) {
      if ($candidate::handles($number)) {
        new $candidate($number);
      }
    }

    $classNames = [
      'BottleNumber6',
      'BottleNumber1',
      'BottleNumber0',
      'BottleNumber',
    ];
    foreach ($classNames as $className) {
      if ($className::handles($number)) {
        return new $className($number);
      }
    }
  }

  public static function handles($number): bool {
    return true;
  }

  public function __construct($number) {
    $this->number = $number;
  }

  public function __toString() {
    return $this->quantity() . ' ' . $this->container();
  }

  public function quantity() {
    return (string)$this->number;
  }

  public function container() {
    return "bottles";
  }

  public function action() {
    return "Take {$this->pronoun()} down and pass it around";
  }

  public function pronoun() {
    return "one";
  }

  public function successor() {
    return BottleNumber::for($this->number - 1);
  }
}
BottleNumber::register(BottleNumber::class);

class BottleNumber0 extends BottleNumber {
  public static function handles($number): bool {
    return $number === 0;
  }

  public function quantity() {
    return "no more";
  }

  public function action() {
    return "Go to the store and buy some more";
  }

  public function successor() {
    return BottleNumber::for(99);
  }
}
BottleNumber::register(BottleNumber0::class);

class BottleNumber1 extends BottleNumber {
  public static function handles($number): bool {
    return $number === 1;
  }

  public function container() {
    return "bottle";
  }

  public function pronoun() {
    return "it";
  }
}
BottleNumber::register(BottleNumber1::class);

class BottleNumber6 extends BottleNumber {
  public static function handles($number): bool {
    return $number === 6;
  }

  public function quantity() {
    return "1";
  }

  public function container() {
    return "six-pack";
  }
}
BottleNumber::register(BottleNumber6::class);
