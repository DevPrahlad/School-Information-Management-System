<!DOCTYPE html>
<html lang="en">

<head>
    <title>Faculty Panel ||View Data Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
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

        th, td {
            padding: 10px;
            border: 1px solid #ffcccc;
            text-align: left;
        }

        th {
            background-color: #ff6666;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #ff6666;
            border: 2px solid #ff6666;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        a:hover {
            background-color: #ff6666;
            color: #fff;
        }

        div.container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffe6e6;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
          @media print {
            body {
                background-color: #ffffff;
            }

            a {
                display: none;
            }

            div.container {
                background-color: #ffffff;
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <?php
    include('database.php');
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    if (isset($_GET['id'])) {
        $userID = $_SESSION['id'];
        $dataID = $_GET['id'];

        $sql = "SELECT * FROM faculty_fill_data WHERE id = $dataID";
        $result = $con->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<div class='container'>";
            echo "<h1>".$row["schools"]."</h1>";

            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>Faculty Name</td><td>" . $row["name"] . "</td></tr>";
            echo "<tr><td>Department</td><td>" . $row["department"] . "</td></tr>";
            echo "<tr><td>Alloted School</td><td>" . $row["schools"] . "</td></tr>";
            echo "<tr><td>Date</td><td>" . $row["date"] . "</td></tr>";
            echo "<tr><td>Principal Name</td><td>" . $row["pname"] . "</td></tr>";
            echo "<tr><td>Principal Contact No.</td><td>" . $row["pcont"] . "</td></tr>";
            echo "<tr><td>TGT Name</td><td>" . $row["tgtname"] . "</td></tr>";
            echo "<tr><td>TGT Contact No.</td><td>" . $row["tgtcont"] . "</td></tr>";
            echo "<tr><td>PGT Name</td><td>" . $row["pgtname"] . "</td></tr>";
            echo "<tr><td>PGT Contact No.</td><td>" . $row["pgtcont"] . "</td></tr>";
            echo "<tr><td>School Status</td><td>" . $row["school_status"] . "</td></tr>";
            echo "<tr><td>Stream</td><td>" . $row["stream"] . "</td></tr>";
            echo "<tr><td>12th Strength</td><td>" . $row["twelve"] . "</td></tr>";
            echo "<tr><td>Topic Covered</td><td>" . $row["topic_covered"] . "</td></tr>";
            echo "<tr><td>Visit Remark</td><td>" . $row["visit_remark"] . "</td></tr>";
            echo "<tr><td>Data Collected</td><td>" . $row["data_collected"] . "</td></tr>";
            echo "<tr><td>Image</td><td>";
            if (!empty($row["photo_path"])) {
                echo "<img src='" . $row["photo_path"] . "' alt='Image' style='max-width: 200px; max-height: 200px;'>";
            } else {
                echo "No Image";
            }
            echo "</td></tr>";
            echo "</table>";

            echo "<a href='javascript:void(0);' onclick='window.print();'>Print</a>";
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<h1>Data not found</h1>";
            echo "<a href=''>Print</a>";
            echo "</div>";
        }
    } else {
        echo "<div class='container'>";
        echo "<h1>Invalid data ID</h1>";
        echo "<a href=''>Print</a>";
        echo "</div>";
    }
    ?>
</body>

</html>
