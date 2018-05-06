<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include "locations.php";
include "part-a/02/get_distances.php";

global $locations;
$nodes = array_keys($locations);

global $nodes;
global $distances;

// Get an array only of routes
$routes = array_keys($distances);

global $routes;
