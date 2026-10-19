<?php

$countries = array(
    "Somalia" => array(
        "capital" => "Mogadishu"
    ),
    "Kenya" => array(
        "capital" => "Nairobi"
    ),
    "Ethiopia" => array(
        "capital" => "Addis Ababa"
    ),
    "Uganda" => array(
        "capital" => "Kampala"
    )
);

function getCapital($country)
{
    global $countries;

    return $countries[$country]["capital"];
}

foreach ($countries as $country => $info) {
    echo "Country: " . $country . "<br>";
    echo "Capital: " . getCapital($country) . "<br><br>";
}

?>