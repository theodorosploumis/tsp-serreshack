<?php

include "functions.php";

print "<div><a href='../'>Go Back</a></div>";
print "<img src='/assets/img/map.png'>";

print "<h2>Part B - 03: Serres -> (through Koumaria, Peponia, Provatas, Skoutari) -> Adelfiko</h2>";

$required_bins = [
  "Koumaria",
  "Peponia",
  "Provatas",
  "Skoutari",
];

for ($j = 1; $j < 8000; $j++) {
  OptimalRoute("Serres", "Adelfiko", 50,  4, $required_bins);
}
