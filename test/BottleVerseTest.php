<?php

require_once __DIR__ . "/../lib/Bottles.php";

class BottleVerseTest extends \PHPUnit\Framework\TestCase {
  public function test_verse_general_rule_upper_bound() {
    $expected =
      "99 bottles of beer on the wall, " .
      "99 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "98 bottles of beer on the wall.\n";
    $this->assertEquals($expected, BottleVerse::lyrics(99));
  }

  public function test_verse_general_rule_lower_bound() {
    $expected =
      "3 bottles of beer on the wall, " .
      "3 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "2 bottles of beer on the wall.\n";
    $this->assertEquals($expected, BottleVerse::lyrics(3));
  }

  public function test_verse_2() {
    $expected =
      "2 bottles of beer on the wall, " .
      "2 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "1 bottle of beer on the wall.\n";
    $this->assertEquals($expected, BottleVerse::lyrics(2));
  }

  public function test_verse_1() {
    $expected =
      "1 bottle of beer on the wall, " .
      "1 bottle of beer.\n" .
      "Take it down and pass it around, " .
      "no more bottles of beer on the wall.\n";
    $this->assertEquals($expected, BottleVerse::lyrics(1));
  }

  public function test_verse_0() {
    $expected =
      "No more bottles of beer on the wall, " .
      "no more bottles of beer.\n" .
      "Go to the store and buy some more, " .
      "99 bottles of beer on the wall.\n";
    $this->assertEquals($expected, BottleVerse::lyrics(0));
  }
}
