<?php
// get_schools.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $region = $_POST["region"];

  // Connect to your MySQL database
  $conn = new mysqli("localhost", "ourwebpr_dk", "1u0lATw[*8dx", "ourwebpr_deeksha");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch schools based on the selected region
  $result = $conn->query("SELECT DISTINCT schools FROM faculty_fill_data WHERE region = '$region'");

  while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row["schools"]}'>{$row["schools"]}</option>";
  }

  $conn->close();
}
?>
