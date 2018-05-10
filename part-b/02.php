<?php

include "functions.php";

print "<div><a href='../'>Go Back</a></div>";
print "<img src='/assets/img/map.png'>";

print "<h2>Part B - 02: Serres -> Adelfiko (only once to Adelfiko)</h2>";
for ($j = 1; $j < 8000; $j++) {
  OptimalRoute("Serres", "Adelfiko", 55, 10);
}