<?php

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
    switch ($number) {
    case 0:
      return
        "No more bottles of beer on the wall, " .
        "no more bottles of beer.\n" .
        "Go to the store and buy some more, " .
        "99 bottles of beer on the wall.\n";
    case 1:
      return
        "{$number} {$this->container($number)} " .
          "of beer on the wall, " .
        "{$number} {$this->container($number)} of beer.\n" .
        "Take {$this->pronoun($number)} down and pass it around, " .
        "{$this->quantity()} bottles of beer on the wall.\n";
    default:
      return
        "{$number} {$this->container($number)} " .
          "of beer on the wall, " .
        "{$number} {$this->container($number)} of beer.\n" .
        "Take {$this->pronoun($number)} down and pass it around, " .
        ($number-1) . " {$this->container($number-1)} " .
          "of beer on the wall.\n";
    }
  }

  public function quantity($number='FIXME') {
    return "no more";
  }

  public function container($number) {
    if ($number === 1) {
      return "bottle";
    } else {
      return "bottles";
    }
  }

  public function pronoun($number) {
    if ($number === 1) {
      return "it";
    } else {
      return "one";
    }
  }
}
