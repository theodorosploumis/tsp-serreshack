<?php

include "../../vendor/autoload.php";
include "../../variables.php";

ini_set('xdebug.max_nesting_level', 1000);

//$distances (the array of all distances)
// $route = "Serres-Provatas"
// $nodes (all Nodes as simple array)

function GetRouteNextNode($route) {
  $new = explode("-",$route);
  return $new[1];
}

function GetRoutePreviousNode($route) {
  $new = explode("-",$route);
  return $new[0];
}

/**
 * @param $route
 * @param $disabled_routes
 *
 * @return array|bool
 */
function DisableRoute($route, $disabled_routes) {
  if (!isset($disabled_routes[$route])) {
    $disabled_routes[] = $route;
    return $disabled_routes;
  } else {
    return false;
  }
}

/**
 * @param $node
 * @param $disabled_nodes
 *
 * @return array|bool
 */
function DisableNode($node, $disabled_nodes) {
  if (!isset($disabled_nodes[$node])) {
    $disabled_nodes[] = $node;
    return $disabled_nodes;
  } else {
    return false;
  }
}

/**
 * @param $empty_bins
 *
 * @return int
 */
function CountPickedBins($empty_bins) {
  $bins = array_values(array_unique($empty_bins));
  return count($bins);
}

function TrackCanMove($node, $new_node) {
  global $distances;
  $key = $node . "-" . $new_node;
  
  if (isset($distances[$key])) {
    return true;
  } else {
    return false;
  }
}

function TrackCanMoveOnlyForward($node, $new_node, $old_route) {
  global $distances;
  $key = $node . "-" . $new_node;
  
  if (isset($distances[$key]) && $old_route !== $new_node . "-" . $node) {
    return true;
  } else {
    return false;
  }
}

function GetRandomNode() {
  global $nodes;
  $random_key = array_rand($nodes);
  return $nodes[$random_key];
}

function GetRandomRoute() {
  global $routes;
  $random_key = array_rand($routes);
  return $routes[$random_key];
}

function GetRandomRouteForward(array $routes, $old_route) {
  if (array_search($old_route, $routes) > 0) {
    $remove_key = array_search($old_route, $routes);
    unset($routes[$remove_key]);
  }
  $random_key = array_rand($routes);
  return $routes[$random_key];
}

function GetMinRouteForward(array $routes, $old_route) {
  if (array_search($old_route, $routes) > 0) {
    $remove_key = array_search($old_route, $routes);
    unset($routes[$remove_key]);
  }
  $key = array_keys($routes, min($routes));
  return $routes[$key[0]];
}

function GetCombinedRouteForward(array $routes, $old_route) {
  $letters = ["a","b"];
  $random_key = array_rand($letters);
  if ($random_key == "a") {
    return GetRandomRouteForward($routes, $old_route);
  } else {
    return GetMinRouteForward($routes, $old_route);
  }
}

/**
 * @param $node (= "Serres")
 *
 * @return array
 */
function GetNextRoutesForNode($node) {
  global $routes;
  $myroutes = $routes;
  
  foreach ($myroutes as $key => $value) {
    if (strpos($value, $node) !== 0) {
      unset($myroutes[$key]);
    }
  }
  return $myroutes;
}

function MoveToNode($start_node, $end_node, $previous_node, $bins = [], $mykm = 0, $paths = "") {

  $mybins = $bins;
  $paths .= $start_node . "<br />";
  global $distances;
  
  if (CountPickedBins($mybins) == 10) {
//    return $array= [
//      "km" => $mykm,
//      "path" => $paths,
//    ];
    
    print $mykm/1000 . "<br />";
    print $paths . "<br />";
    exit();
  }
  
  while (CountPickedBins($mybins) != 10) {
    
    $old_route = $start_node . "-" . $previous_node;
    $next_random_routes = GetNextRoutesForNode($start_node);
    
    if (is_array($next_random_routes)) {
      $next_route = GetCombinedRouteForward($next_random_routes, $old_route);
      $next_node = GetRouteNextNode($next_route);
  
      $key = $start_node . "-" . $next_node;
      $mykm += $distances[$key];
      $mybins[] = $next_node;
  
//  print $key ."<br />";
  
      MoveToNode($next_node, $end_node, $start_node, $mybins, $mykm, $paths);
    }
  }
  
}

MoveToNode("Kato_Mitrousi", "Adelfiko", "");