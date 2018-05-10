<?php

include "functions.php";

print "<div><a href='../'>Go Back</a></div>";
print "<img src='/assets/img/map.png'>";

print "<h2>Part B - 06: Serres -> Adelfiko (each bin weighs X, 2 lorries, 500kg/lorry1, 300kg/lorry2, only once to Adelfiko)</h2>";

$lorry1 = [
  "Serres",
  "Provatas",
  "Ano_Kamila",
  "Kato_Mitrousi",
  "Kato_Kamila",
  "Koumaria",
  "Adelfiko"
];

print "<h2>Lorry 1 (300kg)</h2>";
print "<i>Notice that we choose not to get the bin from Koumaria so the 2nd Lorry has to pick it and Lorry 1 has 50kg less to carry.</i>";

GetDistanceFromFixedNodes($lorry1);

$lorry2 = [
  "Serres",
  "Skoutari",
  "Agia_Eleni",
  "Peponia",
  "Adelfiko",
  "Koumaria",
  "Adelfiko"
];

print "<h2>Lorry 2 (500kg)</h2>";
GetDistanceFromFixedNodes($lorry2);

//for ($j = 1; $j < 8000; $j++) {
//  OptimalRoute("Serres", "Adelfiko", 600, 1);
//}

