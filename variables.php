<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

ini_set('xdebug.max_nesting_level', 10000);
ini_set('max_execution_time', 300);

include "vendor/autoload.php";

include "locations.php";
include "part-a/get_distances.php";

global $locations;
$nodes = array_keys($locations);

global $nodes;
global $distances;

// Get an array only of routes
$routes = array_keys($distances);

global $routes;

$node_weights_fixed = [
  "Adelfiko" => 0,
  "Agia_Eleni" => 100,
  "Ano_Kamila" => 100,
  "Kato_Kamila" => 100,
  "Kato_Mitrousi" => 100,
  "Koumaria" => 100,
  "Peponia" => 100,
  "Provatas" => 100,
  "Serres" => 0,
  "Skoutari" => 100,
];

$node_weights = [
  "Adelfiko" => 0,
  "Agia_Eleni" => 100,
  "Ano_Kamila" => 40,
  "Kato_Kamila" => 40,
  "Kato_Mitrousi" => 160,
  "Koumaria" => 50,
  "Peponia" => 150,
  "Provatas" => 60,
  "Serres" => 0,
  "Skoutari" => 200,
];

global $node_weights, $node_weights_fixed;

$lorry1_kg = 300;
$lorry2_kg = 500;

global $lorry1_kg, $lorry2_kg;
