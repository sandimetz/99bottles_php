<?php

class Bottles {
  private $noMore;
  private $lastOne;
  private $penultimate;
  private $default;

  public function __construct() {
    $this->noMore = function (object $verse): string {
      return
        "No more bottles of beer on the wall, " .
        "no more bottles of beer.\n" .
        "Go to the store and buy some more, " .
        "99 bottles of beer on the wall.\n";
    };
    $this->lastOne = function (object $verse): string {
      return
        "1 bottle of beer on the wall, " .
        "1 bottle of beer.\n" .
        "Take it down and pass it around, " .
        "no more bottles of beer on the wall.\n";
    };
    $this->penultimate = function (object $verse): string {
      return
        "2 bottles of beer on the wall, " .
        "2 bottles of beer.\n" .
        "Take one down and pass it around, " .
        "1 bottle of beer on the wall.\n";
    };
    $this->default = function (object $verse): string {
      return
        $verse->number() . " bottles of beer on the wall, " .
        $verse->number() . " bottles of beer.\n" .
        "Take one down and pass it around, " .
        ($verse->number() - 1) . " bottles of beer on the wall.\n";
    };
  }

  public function song(): string {
    return $this->verses(99, 0);
  }

  public function verses(int $finish, int $start): string {
    return implode("\n", array_map([$this, 'verse'], range($finish, $start)));
  }

  public function verse(int $number): string {
    return $this->verseFor($number)->text();
  }

  private function verseFor(int $number): object {
    switch ($number) {
    case 0:  return new Verse($number, $this->noMore);
    case 1:  return new Verse($number, $this->lastOne);
    case 2:  return new Verse($number, $this->penultimate);
    default: return new Verse($number, $this->default);
    }
  }
}

class Verse {
  protected $number;
  private $lyrics;

  public function __construct(int $number, object $lyrics) {
    $this->number = $number;
    $this->lyrics = $lyrics;
  }

  public function text(): string {
    return ($this->lyrics)($this);
  }

  public function number(): string {
    return $this->number;
  }
}
