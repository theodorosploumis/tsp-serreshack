<?php

// Get ready distance values for each Route from txt file
$file = fopen(__DIR__ . "/distances.txt", "r");
$distances = [];

if ($file) {
  while (($line = fgets($file)) !== false) {
    $pair = explode(":",$line);
    $distances[$pair[0]] = trim($pair[1]);
  }
  fclose($file);
} else {
  print "File distances.txt does not exist";
  return false;
}
