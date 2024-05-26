<?php
// search_data.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $region = $_POST["region"];
  $school = $_POST["school"];

  // Connect to your MySQL database
  $conn = new mysqli("localhost", "ourwebpr_dk", "1u0lATw[*8dx", "ourwebpr_deeksha");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch data based on the selected region and school
  $result = $conn->query("SELECT * FROM faculty_fill_data WHERE region = '$region' AND schools = '$school'");

  echo "<html>";
  echo "<head>";
  echo "<style>";
  echo "h2 { color: #e74c3c; }"; /* Light red heading color */
  echo "table { border-collapse: collapse; width: 100%; margin-top: 20px; background-color: #ffffff; }"; /* White table background */
  echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
  echo "th { background-color: #e74c3c; color: white; }"; /* Light red header background */
  echo "tr:hover { background-color: #f5f5f5; }";
  echo ".view-button { background-color: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }"; /* Light red button color */
  echo "</style>";
  echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
  echo "</head>";
  echo "<body>";

  echo "<h2>Search Results</h2>";

  if ($result->num_rows > 0) {
    echo "<table><tr><th>Sr.No.</th><th>Region</th><th>School</th><th>Year</th><th>Action</th></tr>";
 $cnt=1;
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
       echo "<td>{$cnt}</td>";
      echo "<td>{$row["region"]}</td>";
      echo "<td>{$row["schools"]}</td>";
      echo "<td>" . date("Y", strtotime($row["date"])) . "</td>"; // Display only the year
      echo "<td><a class='view-button' href='view_data.php?region={$row["region"]}&school={$row["schools"]}&date={$row["date"]}'>View</a></td>";
      echo "</tr>";
         $cnt=$cnt+1;
    }

    echo "</table>";
  } else {
    echo "<p>No results found.</p>";
  }

  echo "</body>";
  echo "</html>";

  $conn->close();
}
?>