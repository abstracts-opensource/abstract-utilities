<?php

namespace Ab\Utilities;

class Path {

  public static function clean($path) {
    return trim($path, '/');
  }

  public static function backtrace($origin = '') {
    if (empty($origin)) {
      $origin = getcwd();
    }
    $base_path = rtrim(str_replace('vendor/abstract/utilities/src', '', __DIR__), '/');
    $path = str_replace($base_path, '', $origin);
    $backtrace = '';
    for ($i = 0; $i < count(explode('/', $path)); $i++) $i > 0 ? $backtrace .= '..' : $backtrace .= '';
    return $backtrace;
  }

  public static function root(bool $query_parameters = false) {
    $origin = getcwd();
    $path_full = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $query_strings = str_replace(str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd()), '', $_SERVER['REQUEST_URI']);
    if (!$query_parameters) {
      $query_strings = str_replace((!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : ''), '', $query_strings);
    }
    $base_path = rtrim(str_replace('vendor/abstract/utilities/src', '', __DIR__), '/');
    $path = str_replace($base_path, '', $origin) . $query_strings;
    return str_replace($path, '', $path_full);
  }

  public static function current(bool $query_parameters = false) {
    $origin = getcwd();
    $query_strings = str_replace(str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd()), '', $_SERVER['REQUEST_URI']);
    if (!$query_parameters) {
      $query_strings = str_replace((!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : ''), '', $query_strings);
    }
    $base_path = rtrim(str_replace('vendor/abstract/utilities/src', '', __DIR__), '/');
    $path = str_replace($base_path, '', $origin) . $query_strings;
    return $path;
  }

  public static function thumbnail($path) {
    $file_path = basename($path);
    $directory_path = str_replace($file_path, '', $path);
    return $directory_path . 'thumbnail/' . $file_path;
  }
  
  public static function large($path) {
    $file_path = basename($path);
    $directory_path = str_replace($file_path, '', $path);
    return $directory_path . 'large/' . $file_path;
  }

}