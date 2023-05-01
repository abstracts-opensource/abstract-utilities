<?php

namespace Ab\Utilities;

class Compare {

  public static function arrays($a, $b) {
    if (count($a) != count($b)) {
      return false;
    }
    foreach ($a as $key => $value) {
      if (is_object($value)) {
        $value = (array)$value;
      }
      if (is_array($value)) {
        if (!static::arrays($value, $b[$key])) {
          return false;
        }
      } else {
        if (!isset($b[$key]) || $b[$key] !== $value) {
          return false;
        }
      }
    }
    return true;
  }
  
}
