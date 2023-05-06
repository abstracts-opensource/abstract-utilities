<?php

namespace Ab\Utilities;

use ReflectionClass;
use ReflectionMethod;
use ReflectionFunction;

class Arguments {

  public static function class($objectOrMethod, $arguments) {
    
    $reflection = new ReflectionClass($objectOrMethod);
    $constructor = $reflection->getConstructor();
    $parameters = [];
    if (!empty($constructor)) {
      $parameters = $constructor->getParameters();
    }

    $variables = array_map(function ($parameter, $arguments) {
      extract($arguments);
      $defaultValue = null;
      if ($parameter->isOptional()) {
        $defaultValue = $parameter->getDefaultValue();
      }
      return isset($arguments[$parameter->getName()]) ? $arguments[$parameter->getName()] : $defaultValue;
    }, $parameters, array_fill(0, count($parameters), $arguments));

    return $variables;
    
  }

  public static function method($objectOrMethod, $name, $arguments) {

    $reflection = new ReflectionMethod($objectOrMethod, $name);
    $parameters = [];
    if (!empty($reflection) && count($reflection->getParameters())) {
      $parameters = $reflection->getParameters();
    }

    $variables = array_map(function ($parameter, $arguments) {
      extract($arguments);
      $defaultValue = null;
      if ($parameter->isOptional()) {
        $defaultValue = $parameter->getDefaultValue();
      }
      return isset($arguments[$parameter->getName()]) ? $arguments[$parameter->getName()] : $defaultValue;
    }, $parameters, array_fill(0, count($parameters), $arguments));

    return $variables;

  }

  public static function function($name, $arguments) {

    $reflection = new ReflectionFunction($name);
    $parameters = [];
    if (!empty($reflection) && count($reflection->getParameters())) {
      $parameters = $reflection->getParameters();
    }

    $variables = array_map(function ($parameter, $arguments) {
      extract($arguments);
      $defaultValue = null;
      if ($parameter->isOptional()) {
        $defaultValue = $parameter->getDefaultValue();
      }
      return isset($arguments[$parameter->getName()]) ? $arguments[$parameter->getName()] : $defaultValue;
    }, $parameters, array_fill(0, count($parameters), $arguments));

    return $variables;

  }
}
