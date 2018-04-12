<?php
require_once '/Faker/src/autoload.php';
$faker = Faker\Factory::create();
for ($i=0; $i < 10; $i++) {
  echo $faker->name, "<br>";
}

?>

