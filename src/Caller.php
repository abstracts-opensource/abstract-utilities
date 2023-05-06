<?php

namespace Ab\Utilities;

use Ab\Utilities\Arguments;

use ReflectionClass;

class Caller {

  public static function class($name, $arguments = []) {
    $reflection = new ReflectionClass($name);
    return $reflection->newInstanceArgs(Arguments::class($name, $arguments));
  }

  public static function method($class, $name, $arguments = []) {
    return call_user_func_array(array($class, $name), Arguments::method($class, $name, $arguments));
  }

  public static function function($name, $arguments = []) {
    return call_user_func_array($name, Arguments::function($name, $arguments));
  }
}
