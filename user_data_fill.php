
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Faculty Panel || View and Edit Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff; /* Light red background */
            color: #333;
            text-align: center;
        }

        h1 {
            color: #ff6666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
td input {
    border: none;
    outline: none;
    background-color:#ffe6e6; /* Optional: removes the focus border in some browsers */
     font-size: 16px;
}
        th, td {
            padding: 10px;
            border: 1px solid #ffcccc; /* Light red border */
            text-align: left;
        }

        th {
            background-color: #ff6666; /* Dark red background */
            color: #fff;
        }

        button.edit, button.save {
            background-color: #4CAF50; /* Green background */
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.edit:hover, button.save:hover {
            background-color: #45a049; /* Dark green on hover */
        }

        div.container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffe6e6; /* Light red background */
            border: 1px solid #ffcccc; /* Light red border */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
          .btn {
          font-family: "Asap", sans-serif;
    cursor: pointer;
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    width: 80px;
    border: 0;
    padding: 10px 0;
    margin-top: 10px;
    margin-left: -5px;
    border-radius: 5px;
    background-color: #f45b69;
    transition: background-color 300ms;
        }

        .btn:hover {
            background-color: #ff3333; /* Darker red on hover */
        }
    </style>
</head>

<body>
    <?php
    include('database.php');
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_SESSION['id'];
         $id = $_GET['id'];
        // Retrieve the updated values from the form
        $name = $_POST['name'];
        $department = $_POST['department'];
        $schools = $_POST['schools'];
        $date = $_POST['date'];
        $pname = $_POST['pname'];
        $pcont = $_POST['pcont'];
        $tgtname = $_POST['tgtname'];
        $tgtcont = $_POST['tgtcont'];
        $pgtname = $_POST['pgtname'];
        $pgtcont = $_POST['pgtcont'];
        $school_status = $_POST['school_status'];
        $stream = $_POST['stream'];
        $twelve = $_POST['twelve'];
        $topic_covered = $_POST['topic_covered'];
        $visit_remark = $_POST['visit_remark'];
        $data_collected = $_POST['data_collected'];

        // Update the data in the database
        $sql = "UPDATE faculty_fill_data SET 
                name='$name', 
                department='$department', 
                schools='$schools', 
                date='$date', 
                pname='$pname', 
                pcont='$pcont', 
                tgtname='$tgtname', 
                tgtcont='$tgtcont', 
                pgtname='$pgtname', 
                pgtcont='$pgtcont', 
                school_status='$school_status', 
                stream='$stream', 
                twelve='$twelve', 
                topic_covered='$topic_covered', 
                visit_remark='$visit_remark', 
                data_collected='$data_collected' 
                WHERE id=$id";

        if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $con->error;
        }
    }

    if (isset($_GET['id'])) {
        $userID = $_SESSION['id'];
        $dataID = $_GET['id'];

        $sql = "SELECT * FROM faculty_fill_data WHERE user_id = $userID AND id = $dataID";
        $result = $con->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<div class='container'>";
            echo "<h1>View and Edit Data</h1>";

            echo "<button class='btn' onclick='enableEdit()'>Edit</button>";

            echo "<form method='post' action=''>";
            echo "<table id='data-table'>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>Faculty Name</td><td><input type='text' name='name' value='" . $row["name"] . "' readonly></td></tr>";
            echo "<tr><td>Department</td><td><input type='text' name='department' value='" . $row["department"] . "'readonly></td></

tr>";
            echo "<tr><td>Allotted School</td><td><input type='text' name='schools' value='" . $row["schools"] . "'readonly></td></tr>";
            echo "<tr><td>Date</td><td><input type='text' name='date' value='" . $row["date"] . "'readonly></td></tr>";
            echo "<tr><td>Principal Name</td><td><input type='text' name='pname' value='" . $row["pname"] . "'readonly></td></tr>";
            echo "<tr><td>Principal Contact No.</td><td><input type='text' name='pcont' value='" . $row["pcont"] . "'readonly></td></tr>";
            echo "<tr><td>TGT Name</td><td><input type='text' name='tgtname' value='" . $row["tgtname"] . "'readonly></td></tr>";
            echo "<tr><td>TGT Contact No.</td><td><input type='text' name='tgtcont' value='" . $row["tgtcont"] . "'></td></tr>";
            echo "<tr><td>PGT Name</td><td><input type='text' name='pgtname' value='" . $row["pgtname"] . "'readonly></td></tr>";
            echo "<tr><td>PGT Contact No.</td><td><input type='text' name='pgtcont' value='" . $row["pgtcont"] . "'readonly></td></tr>";
            echo "<tr><td>School Status</td><td><input type='text' name='school_status' value='" . $row["school_status"] .

 "'readonly></td></tr>";
            echo "<tr><td>Stream</td><td><input type='text' name='stream' value='" . $row["stream"] . "'readonly></td></tr>";
            echo "<tr><td>12th Strength</td><td><input type='text' name='twelve' value='" . $row["twelve"] . "'readonly></td></tr>";
            echo "<tr><td>Topic Covered</td><td><input type='text' name='topic_covered' value='" . $row["topic_covered"] . "'readonly></td></tr>";
            echo "<tr><td>Visit Remark</td><td><input type='text' name='visit_remark' value='" . $row["visit_remark"] . "'readonly></td></tr>";
            echo "<tr><td>Data Collected</td><td><input type='text' name='data_collected' value='" . $row["data_collected"] . "'readonly></td></tr>";
            echo "<tr><td>Image</td><td>";
            if (!empty($row["photo_path"])) {
                echo "<img src='" . $row["photo_path"] . "' alt='Image' style='max-width: 200px; max-height: 200px;'>";
            } else {
                echo "No Image";
            }
            echo "</td></tr>";
            echo "</table>";

            echo "<button class='btn' type='submit'>Save</button>";
            echo "</form>";

           
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<h1>Data not found</h1>";
     
            echo "</div>";
        }
    } else {
        echo "<div class='container'>";
        echo "<h1>Invalid data ID</h1>";
       
        echo "</div>";
    }
    ?>

    <script>
        function enableEdit() {
            var inputs = document.querySelectorAll('#data-table input');
            inputs.forEach(function (input) {
                input.removeAttribute('readonly');
            });
        }
    </script>
</body>

</html>
