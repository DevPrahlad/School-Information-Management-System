<?php
include 'database.php';

// Fetch data from the faculty_fill_data table
$sql = "SELECT * FROM faculty_fill_data";
$result = $con->query($sql);

// Generate CSV data with a header row
$csvData = "ID,Name,Depeartment,School,Board,Date,Principal Name,Principal Contact No.,TGT name,TGT Contact No.,PGT Name,PGT Contact No.,Stream,12th Strength,Topic Covered,Visist Remark\n"; // Header row

while ($row = $result->fetch_assoc()) {
    $csvData .=$row['id'] . ',' . $row['name'] . ',' . $row['department'] . ',' . $row['schools'] .',' . $row['school_status'] .',' .$row['date'] .','  . $row['pname'] .',' . $row['pcont'] .',' . $row['tgtname'] .',' . $row['tgtcont'] .',' . $row['pgtname'] .',' . $row['pgtcont'] .',' . $row['stream'] .',' . $row['twelve'] .',' . $row['topic_covered'] .',' . $row['visit_remark'] . "\n";
    // Add more columns as needed
}

// Set the headers for CSV file download
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="faculty_data.csv"');

// Output the CSV data
echo $csvData;

$con->close();
?>
