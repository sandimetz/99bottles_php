<?php

class Bottles {
  public function song() {
    return $this->verses(99, 0);
  }

  public function verses($bottlesAtStart, $bottlesAtEnd) {
    $verses = [];
    foreach (range($bottlesAtStart, $bottlesAtEnd) as $verseNumber) {
      $verses[] = $this->verse($verseNumber);
    }

    return implode("\n", $verses);
  }

  public function verse($bottles) {
    return (string)new Round($bottles);
  }
}

class Round {
  public $bottles;

  public function __construct($bottles) {
    $this->bottles = $bottles;
  }

  public function __toString() {
    return $this->challenge() . $this->response();
  }

  public function challenge() {
    return ucfirst($this->bottlesOfBeer()) . ' ' .
      $this->onWall() . ', ' . $this->bottlesOfBeer() . ".\n";
  }

  public function response() {
    return $this->goToTheStoreOrTakeOneDown() . ', ' .
      $this->bottlesOfBeer() . ' ' . $this->onWall() . ".\n";
  }

  public function bottlesOfBeer() {
    return "{$this->anglicizedBottleCount()} " .
      "{$this->pluralizedBottleForm()} of {$this->beer()}";
  }

  public function beer() {
    return 'beer';
  }

  public function onWall() {
    return 'on the wall';
  }

  public function pluralizedBottleForm() {
    return $this->lastBeer() ? 'bottle' : 'bottles';
  }

  public function anglicizedBottleCount() {
    return $this->allOut() ?
      'no more' : (string)$this->bottles;
  }

  public function goToTheStoreOrTakeOneDown() {
    if ($this->allOut()) {
      $this->bottles = 99;
      return $this->buyNewBeer();
    } else {
      $lyrics = $this->drinkBeer();
      $this->bottles--;
      return $lyrics;
    }
  }

  public function buyNewBeer() {
    return 'Go to the store and buy some more';
  }

  public function drinkBeer() {
    return "Take {$this->itOrOne()} down and pass it around";
  }

  public function itOrOne() {
    return $this->lastBeer() ? 'it' : 'one';
  }

  public function allOut() {
    return $this->bottles === 0;
  }

  public function lastBeer() {
    return $this->bottles === 1;
  }
}
