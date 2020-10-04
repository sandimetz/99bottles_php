<?php

declare(strict_types = 1);

class Bottles {
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
    switch ($number) {
    case 0:
      return
        ucfirst($this->quantity($number)) . " bottles" .
          " of beer on the wall, " .
        "no more bottles of beer.\n" .
        "Go to the store and buy some more, " .
        "99 bottles of beer on the wall.\n";
    default:
      return
        ucfirst($this->quantity($number)) . " " . $this->container($number) .
          " of beer on the wall, " .
        $number . " " . $this->container($number) . " of beer.\n" .
        "Take " . $this->pronoun($number) . " down and pass it around, " .
        $this->quantity($number-1) . " " . $this->container($number-1) .
          " of beer on the wall.\n";
    }
  }

  public function quantity(int $number): string {
    if ($number === 0) {
      return "no more";
    } else {
      return $number;
    }
  }

  public function container(int $number): string {
    if ($number === 1) {
      return "bottle";
    } else {
      return "bottles";
    }
  }

  public function pronoun(int $number): string {
    if ($number === 1) {
      return "it";
    } else {
      return "one";
    }
  }
}
