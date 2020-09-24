<?php

declare(strict_types = 1);

class CountdownSong {
  protected $verseTemplate, $min, $max;

  public function __construct($verseTemplate = BottleVerse::class, $max = 99, $min = 0) {
    $this->verseTemplate = $verseTemplate;
    $this->max = $max;
    $this->min = $min;
  }

  public function song() {
    return $this->verses($this->max, $this->min);
  }

  public function verses($upper, $lower) {
    $verses = [];
    foreach (range($upper, $lower) as $i) {
      $verses[] = $this->verse($i);
    }

    return implode("\n", $verses);
  }

  public function verse($number) {
    return $this->verseTemplate::lyrics($number);
  }
}

interface CountdownSongVerse {
  public static function lyrics($number);
}

class BottleVerse implements CountdownSongVerse {
  protected $bottleNumber;

  public static function lyrics($number) {
    return (new BottleVerse(BottleNumber::for($number)))->_lyrics();
  }

  public function __construct($bottleNumber) {
    $this->bottleNumber = $bottleNumber;
  }

  private function _lyrics() {
    return
      ucfirst("{$this->bottleNumber} of beer on the wall, ") .
      "{$this->bottleNumber} of beer.\n" .
      "{$this->bottleNumber->action()}, " .
      "{$this->bottleNumber->successor()} of beer on the wall.\n";
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
