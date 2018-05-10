<?php

include "part-b/functions.php";

print "<div><a href='/'>Go Home</a></div>";
print "<img src='/assets/img/map.png'>";

GetDistanceFromFixedNodes(["Koumaria", "Adelfiko"]);

for ($j = 1; $j < 8000; $j++) {
  OptimalRoute("Serres", "Adelfiko", 55, 10);
}
