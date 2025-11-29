<?php
echo "heelo";

$bien = 5;
$boolean = true;


// -- array 
$array = [3, 3, 2, 2];
foreach ($array as $number) {
  echo $number;
}

$students = [
  [
    "masv" => "a",
    "diem" => 4
  ],
  [
    "masv" => "b",
    "diem" => 5
  ],
];

// foreach lay ra key => value 
foreach ($students as $key => $value) {
  echo $key;
  echo $value;
  echo "<br";
}

// function . 
function nameFunction() {}

// isset 
if ($_POST["login"]) {
  $fullName = $_POST["fullName"];
}
