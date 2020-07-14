<?php

require __DIR__ . "/../lib/Bottles.php";

class BottlesTest extends \PHPUnit\Framework\TestCase {
  public function test_the_php_setup() {
    $this->assertEquals("Setup okay", "Setup okay");
  }
}