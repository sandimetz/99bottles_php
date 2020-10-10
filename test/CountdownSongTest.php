<?php

require_once __DIR__ . "/../lib/Bottles.php";

class VerseFake implements CountdownSongVerse {
  public static function lyrics(int $number): string {
    return "This is verse {$number}.\n";
  }
}

class CountdownSongTest extends \PHPUnit\Framework\TestCase {
  public function test_verse() {
    $expected =
      "This is verse 500.\n";
    $this->assertEquals(
      $expected,
      (new CountdownSong(VerseFake::class))->verse(500)
    );
  }

  public function test_verses() {
    $expected =
      "This is verse 99.\n" .
      "\n" .
      "This is verse 98.\n" .
      "\n" .
      "This is verse 97.\n";
    $this->assertEquals(
      $expected,
      (new CountdownSong(VerseFake::class))->verses(99, 97)
    );
  }

  public function test_song() {
    $expected =
      "This is verse 47.\n" .
      "\n" .
      "This is verse 46.\n" .
      "\n" .
      "This is verse 45.\n" .
      "\n" .
      "This is verse 44.\n" .
      "\n" .
      "This is verse 43.\n";
    $this->assertEquals(
      $expected,
      (new CountdownSong(VerseFake::class, 47, 43))->song()
    );
  }
}
