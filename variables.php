<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

ini_set('xdebug.max_nesting_level', 10000);
ini_set('max_execution_time', 300);

include "vendor/autoload.php";
include __DIR__ . "/part-a/get_distances.php";

$locations = [
  "Serres" => [
    "lat" => 41.092083,
    "lon" => 23.541016
  ],
  "Provatas" => [
    "lat" => 41.068238,
    "lon" => 23.390686
  ],
  "Ano_Kamila" => [
    "lat" => 41.058320,
    "lon" => 23.424134
  ],
  "Kato_Kamila" => [
    "lat" => 41.020431,
    "lon" => 23.483293
  ],
  "Kato_Mitrousi" => [
    "lat" => 41.058680,
    "lon" => 23.457547
  ],
  "Koumaria" => [
    "lat" => 41.016434,
    "lon" => 23.434656
  ],
  "Skoutari" => [
    "lat" => 41.020032,
    "lon" => 23.520701
  ],
  "Adelfiko" => [
    "lat" => 41.014645,
    "lon" => 23.457354
  ],
  "Agia_Eleni" => [
    "lat" => 41.003545,
    "lon" => 23.559196
  ],
  "Peponia" => [
    "lat" => 40.988154,
    "lon" => 23.516756
  ],
];

$nodes = array_keys($locations);

// Get an array only of routes
$routes = array_keys($distances);

// Each bin weight
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

// Each bin fixed weight
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

$lorry1_kg = 300;
$lorry2_kg = 500;

global $locations,
       $nodes,
       $distances,
       $routes,
       $node_weights,
       $node_weights_fixed,
       $lorry1_kg,
       $lorry2_kg;
