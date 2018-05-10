<?php

include "functions.php";

print "<div><a href='../'>Go Back</a></div>";
print "<img src='/assets/img/map.png'>";

print "<h2>Part B - 05: Serres -> Adelfiko (each bin weighs 100kg, 2 lorries, 400kg/lorry, only once to Adelfiko)</h2>";
print "<i>Notice that we choose not to get the bin from Koumaria so the 2nd Lorry has to pick it and Lorry 1 has 100kg less to carry.</i>";

// After some experiments with the code above we end to prefer this trip:
$lorry1 = [
  "Serres",
  "Provatas",
  "Ano_Kamila",
  "Kato_Mitrousi",
  "Kato_Kamila",
  "Koumaria",
  "Adelfiko"
];

GetDistanceFromFixedNodes($lorry1, $node_weights_fixed);

//for ($j = 1; $j < 8000; $j++) {
//  OptimalRoute("Serres", "Adelfiko", 40,  5, $lorry1);
//}

// Remove Koumaria so the 2nd Lorry can pick its dustbin
if (array_search("Koumaria", $lorry1) > 0) {
  $remove_keys = array_search(["Adelfiko", "Koumaria", "Serres"], $lorry1);
  unset($lorry1[$remove_keys]);
}

// Get remaining Nodes
//$lorry2 = array_diff($nodes, $lorry1);

// Calculate 2nd lorry route
//for ($j = 1; $j < 8000; $j++) {
//  OptimalRoute("Serres", "Adelfiko", 26,  4, $lorry2);
//}

$fixed_lorry2 = [
  "Serres",
  "Skoutari",
  "Agia_Eleni",
  "Peponia",
  "Adelfiko",
  "Koumaria",
  "Adelfiko"
];

GetDistanceFromFixedNodes($fixed_lorry2, $node_weights_fixed);
