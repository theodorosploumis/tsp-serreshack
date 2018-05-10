<?php

include "functions.php";

print "<div><a href='../'>Go Back</a></div>";
print "<img src='/assets/img/map.png'>";

print "<h2>Part B - 04: Serres -> Adelfiko (at least through Koumaria, Skoutari, Peponia, Provatas and also A. Kamila and K. Mitrousi)</h2>";

//$required_bins = [
//  "Provatas",
//];
//for ($j = 1; $j < 8000; $j++) {
//  OptimalRoute("Serres", "Koumaria", 27,  1, $required_bins); // 26km
//}

GetDistanceFromFixedNodes(["Serres", "Provatas", "Ano_Kamila", "Koumaria"]);

$required_bins = [
  "Ano_Kamila",
  "Kato_Mitrousi",
  "Peponia"
];

for ($j = 1; $j < 8000; $j++) {
  OptimalRoute("Koumaria", "Adelfiko", 32,  3, $required_bins);
}
