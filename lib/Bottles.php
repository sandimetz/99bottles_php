<?php

class Bottles {
  public function verse(int $number): string {
    return
      $number . " bottles of beer on the wall, " .
      $number . " bottles of beer.\n" .
      "Take one down and pass it around, " .
      ($number-1) . " bottles of beer on the wall.\n";
  }
}
