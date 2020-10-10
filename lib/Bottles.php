<?php

declare(strict_types = 1);

class Bottles {
  protected $verseTemplate;

  public function __construct(string $verseTemplate = BottleVerse::class) {
    $this->verseTemplate = $verseTemplate;
  }

  public function song(): string {
    return $this->verses(99, 0);
  }

  public function verses(int $upper, int $lower): string {
    return implode(
      "\n",
      array_map([$this, 'verse'], range($upper, $lower))
    );
  }

  public function verse(int $number): string {
    return $this->verseTemplate::lyrics($number);
  }
}

class BottleVerse {
  protected $number;
  protected $bottleNumber;

  public static function lyrics(int $number): string {
    return (new BottleVerse(BottleNumber::for($number)))->_lyrics();
  }

  public function __construct(object $number) {
    $this->number = $number;
    $this->bottleNumber = $number;
  }

  private function _lyrics(): string {
    $bottleNumber = $this->number;

    return
      ucfirst("{$this->bottleNumber} of beer on the wall, ") .
      "{$this->bottleNumber} of beer.\n" .
      "{$this->bottleNumber->action()}, " .
      "{$this->bottleNumber->successor()} of beer on the wall.\n";
  }
}

class BottleNumber {
  protected $number;

  public static function for(int $number): object {
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

  public function __toString(): string {
    return $this->quantity() . " " . $this->container();
  }

  public function quantity(): string {
    return (string)$this->number;
  }

  public function container(): string {
    return "bottles";
  }

  public function action(): string {
    return "Take " . $this->pronoun() . " down and pass it around";
  }

  public function pronoun(): string {
    return "one";
  }

  public function successor(): object {
    return BottleNumber::for($this->number - 1);
  }
}

class BottleNumber0 extends BottleNumber {
  public function quantity(): string {
    return "no more";
  }

  public function action(): string {
    return "Go to the store and buy some more";
  }

  public function successor(): object {
    return BottleNumber::for(99);
  }
}

class BottleNumber1 extends BottleNumber {
  public function container(): string {
    return "bottle";
  }

  public function pronoun(): string {
    return "it";
  }
}

class BottleNumber6 extends BottleNumber {
  public function quantity(): string {
    return "1";
  }

  public function container(): string {
    return "six-pack";
  }
}
