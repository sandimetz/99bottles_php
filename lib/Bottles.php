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
    return (new BottleVerse($number))->lyrics();
    $bottleNumber = BottleNumber::for($number);

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$bottleNumber->successor()} of beer on the wall.\n";
  }
}

class BottleVerse {
  protected $number;

  public function __construct($number) {
    $this->number = $number;
  }

  public function lyrics() {
    $bottleNumber = BottleNumber::for($this->number);

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$bottleNumber->successor()} of beer on the wall.\n";
  }
}

class BottleNumber {
  protected $number;

  public static function for($number) {
    switch ($number) {
    case 0:
      $className = BottleNumber0::class;
      break;
    case 1:
      $className = BottleNumber1::class;
      break;
    case 6:
      $className = BottleNumber6::class;
      break;
    default:
      $className = BottleNumber::class;
      break;
    }
    return new $className($number);
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

class BottleNumber0 extends BottleNumber {
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

class BottleNumber1 extends BottleNumber {
  public function container() {
    return "bottle";
  }

  public function pronoun() {
    return "it";
  }
}

class BottleNumber6 extends BottleNumber {
  public function quantity() {
    return "1";
  }

  public function container() {
    return "six-pack";
  }
}
