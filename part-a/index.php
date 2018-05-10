<?php

include __DIR__. "/../variables.php";

print "<div><a href='/'>Homepage</a></div>";
print "<img src='/assets/img/map.png'>";

if ($distances) {
  print "<h2>Distances already calculated</h2>";
  
  foreach ($distances as $key => $value) {
    print $key . ":" . $value . "<br />";
  }
  exit();
}

// Global variables
$results_file = "distances.txt";
$google_maps_key = file_get_contents(__DIR__ . "/../key.txt");

global $google_maps_key;

/**
 * @param $locations
 * @param $origin
 * @param $destination
 *
 * @return mixed
 */
function GoogleMapsDistanceCalculator($locations, $origin, $destination) {
  
  global $google_maps_key;
  
  $key = $google_maps_key;

  $origin_lat = $locations[$origin]['lat'];
  $origin_lon = $locations[$origin]['lon'];

  $destination_lat = $locations[$destination]['lat'];
  $destination_lon = $locations[$destination]['lon'];

  $path = 'https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.$origin_lat.','.$origin_lon.'&destinations='.$destination_lat . ','. $destination_lon .'&key=' . $key;

  // Get cURL resource
  $curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $path
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  $result = json_decode($response);

  return $result->rows[0]->elements[0]->distance->value;
}

// Start calculating distances
$distances = [];

// Serres node
$distances['Serres-Provatas'] = $distances['Provatas-Serres'] = GoogleMapsDistanceCalculator($locations, "Serres", "Provatas");
$distances['Serres-Kato_Mitrousi'] = $distances['Kato_Mitrousi-Serres'] = GoogleMapsDistanceCalculator($locations, "Serres", "Kato_Mitrousi");
$distances['Serres-Skoutari'] = $distances['Skoutari-Serres'] = GoogleMapsDistanceCalculator($locations, "Serres", "Skoutari");

// Provatas node
$distances['Provatas-Ano_Kamila'] = $distances['Ano_Kamila-Provatas'] = GoogleMapsDistanceCalculator($locations, "Provatas", "Ano_Kamila");

// Kato Mitrousi node
$distances['Kato_Mitrousi-Ano_Kamila'] = $distances['Ano_Kamila-Kato_Mitrousi'] = GoogleMapsDistanceCalculator($locations, "Kato_Mitrousi", "Ano_Kamila");
$distances['Kato_Mitrousi-Kato_Kamila'] = $distances['Kato_Kamila-Kato_Mitrousi'] = GoogleMapsDistanceCalculator($locations, "Kato_Mitrousi", "Kato_Kamila");
$distances['Kato_Mitrousi-Koumaria'] = $distances['Koumaria-Kato_Mitrousi'] = GoogleMapsDistanceCalculator($locations, "Kato_Mitrousi", "Koumaria");

// Ano Kamila node
$distances['Koumaria-Ano_Kamila'] = $distances['Ano_Kamila-Koumaria'] = GoogleMapsDistanceCalculator($locations, "Koumaria", "Ano_Kamila");

// Kato Kamila Node
$distances['Kato_Kamila-Skoutari'] = $distances['Skoutari-Kato_Kamila'] = GoogleMapsDistanceCalculator($locations, "Kato_Kamila", "Skoutari");
$distances['Kato_Kamila-Koumaria'] = $distances['Koumaria-Kato_Kamila'] = GoogleMapsDistanceCalculator($locations, "Kato_Kamila", "Koumaria");

// Skoutari Node
$distances['Skoutari-Peponia'] = $distances['Peponia-Skoutari'] = GoogleMapsDistanceCalculator($locations, "Skoutari", "Peponia");
$distances['Skoutari-Agia_Eleni'] = $distances['Agia_Eleni-Skoutari'] = GoogleMapsDistanceCalculator($locations, "Skoutari", "Agia_Eleni");

// Koumaria Node
$distances['Koumaria-Adelfiko'] = $distances['Adelfiko-Koumaria'] = GoogleMapsDistanceCalculator($locations, "Koumaria", "Adelfiko");

// Peponia Node
$distances['Peponia-Adelfiko'] = $distances['Adelfiko-Peponia'] = GoogleMapsDistanceCalculator($locations, "Peponia", "Adelfiko");
$distances['Peponia-Agia_Eleni'] = $distances['Agia_Eleni-Peponia'] = GoogleMapsDistanceCalculator($locations, "Peponia", "Agia_Eleni");

// Save calculations locally, trancate old values
$file = fopen($results_file, "w");

foreach ($distances as $pair => $value) {
  fwrite($file, $pair . ":" . $value.PHP_EOL);
}
fclose($file);

if ($distances) {
  print "<h2>Calculated distances successfully!</h2>";
  
  foreach ($distances as $key => $value) {
    print $key . ":" . $value . "<br />";
  }
  exit();
}
