<?php 

  function filter_array_by_keys($array, $keys = array()) {
    return array_filter($array, function($key) use ($keys) {
      return in_array($key, $keys);
    }, ARRAY_FILTER_USE_KEY);
  }

  function filter_array_empty_values($array, $indexed = false) {
    $filtered_array = array_filter($array, function($value) {
      return !empty($value) && !is_null($value) && (is_string($value) ? strlen(trim($value)) > 0 : true);
    });

    return $indexed ? array_values($filtered_array) : $filtered_array;
  }