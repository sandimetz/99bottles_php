<?php

class Bottles {
  public function song(): string {
    return $this->verses(99, 0);
  }

  public function verses(int $bottlesAtStart, int $bottlesAtEnd): string {
    return implode("\n", array_map([$this, 'verse'], range($bottlesAtStart, $bottlesAtEnd)));
  }

  public function verse(int $bottles): string {
    return (string)new Round($bottles);
  }
}

class Round {
  public $bottles;

  public function __construct(int $bottles) {
    $this->bottles = $bottles;
  }

  public function __toString(): string {
    return $this->challenge() . $this->response();
  }

  public function challenge(): string {
    return ucfirst($this->bottlesOfBeer()) . ' ' .
      $this->onWall() . ', ' . $this->bottlesOfBeer() . ".\n";
  }

  public function response(): string {
    return $this->goToTheStoreOrTakeOneDown() . ', ' .
      $this->bottlesOfBeer() . ' ' . $this->onWall() . ".\n";
  }

  public function bottlesOfBeer(): string {
    return $this->anglicizedBottleCount() . ' ' .
      $this->pluralizedBottleForm() . ' of ' . $this->beer();
  }

  public function beer(): string {
    return 'beer';
  }

  public function onWall(): string {
    return 'on the wall';
  }

  public function pluralizedBottleForm(): string {
    return $this->lastBeer() ? 'bottle' : 'bottles';
  }

  public function anglicizedBottleCount(): string {
    return $this->allOut() ?
      'no more' : (string)$this->bottles;
  }

  public function goToTheStoreOrTakeOneDown(): string {
    if ($this->allOut()) {
      $this->bottles = 99;
      return $this->buyNewBeer();
    } else {
      $lyrics = $this->drinkBeer();
      $this->bottles--;
      return $lyrics;
    }
  }

  public function buyNewBeer(): string {
    return 'Go to the store and buy some more';
  }

  public function drinkBeer(): string {
    return 'Take ' . $this->itOrOne() . ' down and pass it around';
  }

  public function itOrOne(): string {
    return $this->lastBeer() ? 'it' : 'one';
  }

  public function allOut(): bool {
    return $this->bottles === 0;
  }

  public function lastBeer(): bool {
    return $this->bottles === 1;
  }
}
