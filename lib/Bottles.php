<?php

class Bottles {
  public function song(): string {
    return $this->verses(99, 0);
  }

  public function verses(int $hi, int $lo): string {
    return implode("\n", array_map([$this, 'verse'], range($hi, $lo)));
  }

  public function verse(int $n): string {
    return
      ($n === 0 ? 'No more' : $n) . ' bottle' . ($n === 1 ? '' : 's') .
      ' of beer on the wall, ' .
      ($n === 0 ? 'no more' : $n) . ' bottle' . ($n === 1 ? '' : 's') .
      " of beer.\n" .
      ($n > 0   ? 'Take ' . ($n > 1 ? 'one' : 'it') . ' down and pass it around, '
                : 'Go to the store and buy some more, ') .
      ($n-1 < 0 ? 99 : ($n-1 === 0 ? 'no more' : $n-1)) .
      ' bottle' . ($n-1 === 1 ? '' : 's') . " of beer on the wall.\n";
  }
}
