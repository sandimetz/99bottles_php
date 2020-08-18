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
    $bottleNumber = new BottleNumber($number);
    $nextBottleNumber = new BottleNumber($bottleNumber->successor());

    return
      ucfirst("{$bottleNumber} of beer on the wall, ") .
      "{$bottleNumber} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$nextBottleNumber} " . "of beer on the wall.\n";
  }
}

class BottleNumber {
  protected $number;

  public function __construct($number) {
    $this->number = $number;
  }

  public function __toString() {
    return $this->quantity() . ' ' . $this->container();
  }

  public function quantity() {
    if ($this->number === 0) {
      return "no more";
    } else {
      return (string)$this->number;
    }
  }

  public function container() {
    if ($this->number === 1) {
      return "bottle";
    } else {
      return "bottles";
    }
  }

  public function action() {
    if ($this->number === 0) {
      return "Go to the store and buy some more";
    } else {
      return "Take {$this->pronoun()} down and pass it around";
    }
  }

  public function pronoun() {
    if ($this->number === 1) {
      return "it";
    } else {
      return "one";
    }
  }

  public function successor() {
    if ($this->number === 0) {
      return 99;
    } else {
      return $this->number - 1;
    }
  }
}
