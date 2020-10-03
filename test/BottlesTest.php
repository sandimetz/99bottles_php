<?php

require __DIR__ . "/../lib/Bottles.php";

class BottlesTest extends \PHPUnit\Framework\TestCase {
  public function test_the_first_verse() {
    $expected =
      "99 bottles of beer on the wall, " .
      "99 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "98 bottles of beer on the wall.\n";
    $this->assertEquals($expected, (new Bottles())->verse(99));
  }

  public function test_another_verse() {
    $expected =
      "3 bottles of beer on the wall, " .
      "3 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "2 bottles of beer on the wall.\n";
    $this->assertEquals($expected, (new Bottles())->verse(3));
  }

  public function test_verse_2() {
    $expected =
      "2 bottles of beer on the wall, " .
      "2 bottles of beer.\n" .
      "Take one down and pass it around, " .
      "1 bottle of beer on the wall.\n";
    $this->assertEquals($expected, (new Bottles())->verse(2));
  }

  public function test_verse_1() {
    $expected =
      "1 bottle of beer on the wall, " .
      "1 bottle of beer.\n" .
      "Take it down and pass it around, " .
      "no more bottles of beer on the wall.\n";
    $this->assertEquals($expected, (new Bottles())->verse(1));
  }

  public function test_verse_0() {
    $expected =
      "No more bottles of beer on the wall, " .
      "no more bottles of beer.\n" .
      "Go to the store and buy some more, " .
      "99 bottles of beer on the wall.\n";
    $this->assertEquals($expected, (new Bottles())->verse(0));
  }
}
