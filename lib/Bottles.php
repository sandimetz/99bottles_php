<?php

class Bottles
{
  private $noMore;
  private $lastOne;
  private $penultimate;
  private $default;

  public function __construct()
  {
    $this->noMore = function ($verse) {
      return
        "No more bottles of beer on the wall, " .
        "no more bottles of beer.\n" .
        "Go to the store and buy some more, " .
        "99 bottles of beer on the wall.\n";
    };
    $this->lastOne = function ($verse) {
      return
        "1 bottle of beer on the wall, " .
        "1 bottle of beer.\n" .
        "Take it down and pass it around, " .
        "no more bottles of beer on the wall.\n";
    };
    $this->penultimate = function ($verse) {
      return
        "2 bottles of beer on the wall, " .
        "2 bottles of beer.\n" .
        "Take one down and pass it around, " .
        "1 bottle of beer on the wall.\n";
    };
    $this->default = function ($verse) {
      return
        "{$verse->number()} bottles of beer on the wall, " .
        "{$verse->number()} bottles of beer.\n" .
        "Take one down and pass it around, " .
        ($verse->number() - 1) . " bottles of beer on the wall.\n";
    };
  }

  public function song()
  {
    return $this->verses(99, 0);
  }

  public function verses($finish, $start)
  {
    return implode(
      "\n",
      array_map(
        function ($verseNumber) {
          return $this->verse($verseNumber);
        },
        range($finish, $start)
      )
    );
  }

  public function verse($number)
  {
    return $this->verseFor($number)->text();
  }

  private function verseFor($number)
  {
    switch ($number) {
    case 0:  return new Verse($number, $this->noMore);
    case 1:  return new Verse($number, $this->lastOne);
    case 2:  return new Verse($number, $this->penultimate);
    default: return new Verse($number, $this->default);
    }
  }
}

class Verse
{
  protected $number;
  private $lyrics;

  public function __construct($number, $lyrics)
  {
    $this->number = $number;
    $this->lyrics = $lyrics;
  }

  public function text()
  {
    return ($this->lyrics)($this);
  }

  public function number()
  {
    return $this->number;
  }
}
