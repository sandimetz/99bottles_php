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
      ucfirst($bottleNumber->quantity()) . " {$bottleNumber->container()} " .
        "of beer on the wall, " .
      "{$bottleNumber->quantity()} {$bottleNumber->container()} of beer.\n" .
      "{$bottleNumber->action()}, " .
      "{$this->quantity($this->successor($number))} " .
        "{$this->container($this->successor($number))} " .
        "of beer on the wall.\n";
  }

  public function quantity($number) {
    return (new BottleNumber($number))->quantity();
  }

  public function container($number) {
    return (new BottleNumber($number))->container();
  }

  public function action($number) {
    return (new BottleNumber($number))->action();
  }

  public function successor($number) {
    return (new BottleNumber($number))->successor();
  }
}

class BottleNumber {
  protected $number;

  public function __construct($number) {
    $this->number = $number;
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
