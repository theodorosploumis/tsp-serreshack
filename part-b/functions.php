<?php

include __DIR__ ."/../variables.php";

// $distances (the array of all distances)
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

function SortBins($bins) {
  $bins = array_values(array_unique($bins));
  sort($bins);
  return $bins;
}

function ArrayDiff($search, $initial) {
  return !array_diff($search, $initial);
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
//
//function RemoveKeyFromArray($array, $value) {
//  if (array_search($value, $array) > 0) {
//    $remove_key = array_search($value, $array);
//    unset($array[$remove_key]);
//  }
//  return $array;
//}

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

/**
 * Usage: OptimalRoute("Serres", "Adelfiko", 60, 10)
 *
 * @param $start_node
 * @param $end_node
 * @param int $km_target
 * @param int $bin_count
 * @param string $previous_node
 * @param array $bins
 * @param int $km
 * @param string $paths
 * @param int $i
 */
function OptimalRoute($start_node, $end_node, $km_target = 70, $bin_count = 10, $required_bins = [], $kg = 0, $previous_node = "", $bins = [], $km = 0, $paths = "", $i = 1) {
  $i++;
  $paths .= $start_node . "<br />";
  
//  global $lorry1_kg;
  
  $bins[] = $start_node;
  $picked_bins = SortBins($bins);
  
//  global $node_weights;
//  $node_weights = array_diff($node_weights, $picked_bins);
  
  if ($required_bins != []) {
    $check_required_bins = ArrayDiff($required_bins, $picked_bins);
  } else {
    $check_required_bins = true;
  }
  
  if (CountPickedBins($bins) >= $bin_count && $start_node == $end_node && $check_required_bins) {
//  if ($kg == $lorry1_kg && $start_node == $end_node && $check_required_bins) {
  
    $bins[] = $end_node;
  
    if ($km / 1000 < $km_target) {
      $message = "<b>km: </b>" . $km / 1000 . "<br />";
//      $message .= "<b>kg </b>" . $kg . "<br />";
      $message .= "<b>Loops:</b> " . $i . "<br />";
      $message .= "<b>Path:</b> <br />" . $paths;
    
      print $message;
      exit();
    }
  } else {
    // Propose next route
    $reverse_route = $start_node . "-" . $previous_node;
    $next_random_routes = GetNextRoutesForNode($start_node);
  
    if (is_array($next_random_routes)) {
      $next_route = GetRandomRouteForward($next_random_routes, $reverse_route); //GetCombinedRouteForward
      $next_node = GetRouteNextNode($next_route);
    
      $key = $start_node . "-" . $next_node;
      
      global $distances;
      $km += $distances[$key];
      
//      if (isset($node_weights[$next_node])) {
//        $kg += $node_weights[$next_node];
//        unset($node_weights[$next_node]);
//      }
    
      // Reuse function
      OptimalRoute($next_node, $end_node, $km_target, $bin_count, $required_bins, $kg, $start_node, $bins, $km, $paths, $i);
    }
  }
  
}

/**
 * Print the fixed Nodes trip within the km
 * Usage GetDistanceFromFixedNodes(["Serres", "Skoutari", "Peponia", "Adelfiko"])
 *
 * @param array $nodes
 * @param null $node_weights
 */
function GetDistanceFromFixedNodes(array $nodes, $node_weights = NULL) {
  global $distances;
  
  if ($node_weights == NULL) {
    global $node_weights;
  }
  
  $km = 0;
  $kg = 0;
  
  print "<ol>";
  
  foreach ($nodes as $key => $value) {
    if (isset($nodes[$key + 1])) {
      $next = $nodes[$key + 1];
      $route = $value . "-" . $next;
      $mykm = $distances[$route]/1000;
      $mykg = $node_weights[$next];
  
      print "<li>" . $route . ": " . $mykm . " (". $mykg ."kg)</li>";
      $km += $mykm;
      $kg += $mykg;
    }
  }
  
  print "</ol>";
  
  print "<div><b>Total km:</b> " . $km . "</div><br />";
  print "<div><b>Total Kg:</b> " . $kg . "</div><br />";
}
