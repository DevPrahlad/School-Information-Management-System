<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
    exit();
}

if (isset($_POST['downloadCSV'])) {
    // Retrieve selected values
    $fromYear = $_POST['fromYear'];
    $toYear = $_POST['toYear'];

    // Connect to the database
    include 'database.php';
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get the total number of students and faculty name for each school in the selected year range
    $query = "SELECT schools, YEAR(STR_TO_DATE(date, '%Y-%m-%d')) as year, 
                     SUM(twelve) as totalStudents, GROUP_CONCAT(DISTINCT name) as facultyNames
              FROM faculty_fill_data
              WHERE YEAR(STR_TO_DATE(date, '%Y-%m-%d')) BETWEEN ? AND ?
              GROUP BY schools, year";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $fromYear, $toYear);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate CSV content
    $csvContent = "School Name,Year,Total Students,Faculty Names\n";

    while ($row = $result->fetch_assoc()) {
        $csvContent .= "{$row['schools']},{$row['year']},{$row['totalStudents']},{$row['facultyNames']}\n";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="analytics_data.csv"');

    // Output the CSV content
    echo $csvContent;
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='sidebar.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Panel || Analytics</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            list-style-type: none;
            padding: 0;
        }

        .dropdown-menu li {
            padding: 8px 16px;
        }

        .dropdown-menu li:hover {
            background-color: #f2f2f2;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .profile-avatar {
            width: 40px;
            /* Adjust according to your design */
            height: 40px;
            /* Adjust according to your design */
            border-radius: 50%;
            /* Makes the image round */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            list-style-type: none;
            padding: 0;
        }

        .dropdown-menu li {
            padding: 8px 16px;
        }

        .dropdown-menu li:hover {
            background-color: #f2f2f2;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }


        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            color: #800000;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #800000;
        }

        .show {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .shows {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ff6666;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        label {
            flex-basis: 48%;
            /* Takes almost half of the container width */
            margin-bottom: 8px;
        }

        input {
            flex-basis: 48%;
            /* Takes almost half of the container width */
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #e6e6e6;
            border-radius: 4px;
        }

        button {
            margin: 20px auto;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #ff6666;
            /* Dark red background color */
            color: #fff;
            /* White text color */
            transition: background-color 0.3s ease-in-out;
            justify-content: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffe6e6;
            /* Light red background color */
            border: 1px solid #ffcccc;
            /* Light red border */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ffcccc;
            /* Light red border */
        }

        th {
            background-color: #ff6666;
            /* Dark red background color */

            color: #fff;
        }

        td {
            color: #333;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">

            <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d" /></span> &nbsp;<H5 style="color:#fff;text-align:center;">DEEKSHA</H5>
        </div>
        <ul class="nav-links">
            <li>
                <a href="user_dash.php">
                    <i class='bx bx-id-card'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="analytics_user.php" class="active">
                    <i class='bx bx-pie-chart-alt'></i>
                    <span class="links_name">Analytics</span>
                </a>
            </li>
            <li>
                <a href="given_allotments.php">
                    <i class='bx bx-highlight'></i>
                    <span class="links_name">Given Allotments</span>
                </a>
            </li>
            <li>
                <a href="completed_allotments.php">
                    <i class='bx bx-check-double'></i>
                    <span class="links_name">Completed Allotments</span>
                </a>
            </li>
            <li>
                <a href="pending_allotments.php">
                    <i class='bx bx-pulse'></i>
                    <span class="links_name">Pending Allotments</span>
                </a>
            </li>
            <li>
                <a href="expired.php">
                    <i class='bx bx-calendar-x'></i>
                    <span class="links_name">Expired Allotments</span>
                </a>
            </li>



        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="avt dropdown">
                <button class="dropdown-toggle" id="profile-dropdown-toggle">
                    <img src="pro_avt.png" alt="Profile Avatar" class="profile-avatar">
                </button>
                <ul class="dropdown-menu" id="profile-dropdown">
                    <li><a href="Profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="home-content">

            <form class="show" method="post">
                <label for="fromYear">From Year:</label>
                <input type="text" name="fromYear" id="fromYear" placeholder="Enter From Year" required>

                <label for="toYear">To Year:</label>
                <input type="text" name="toYear" id="toYear" placeholder="Enter To Year" required>

                <button type="submit" name="submit">Get Analytics</button>
            </form>

            <?php
            // Check if the form is submitted
            if (isset($_POST['submit'])) {
                // Retrieve selected values
                $fromYear = $_POST['fromYear'];
                $toYear = $_POST['toYear'];

                // Connect to the database
                include 'database.php';

                // Check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                // Use the logged-in user's ID to filter results
                $userId = $_SESSION['id'];

                // Query to get the total number of students and faculty name for the logged-in user in the selected year range
                $query = "SELECT schools, YEAR(STR_TO_DATE(date, '%Y-%m-%d')) as year, 
                                 SUM(twelve) as totalStudents, GROUP_CONCAT(DISTINCT name) as facultyNames
                          FROM faculty_fill_data
                          WHERE user_id = ? AND YEAR(STR_TO_DATE(date, '%Y-%m-%d')) BETWEEN ? AND ?
                          GROUP BY schools, year";

                // Use prepared statement to prevent SQL injection
                $stmt = $con->prepare($query);
                $stmt->bind_param("sss", $userId, $fromYear, $toYear);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the result or show an error message
                if ($result) {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='fromYear' value='{$fromYear}'>";
                    echo "<input type='hidden' name='toYear' value='{$toYear}'>";
                    echo "<button type='submit' class='shows' name='downloadCSV'>Download as CSV</button>";
                    echo "</form>";
                    echo "<table border='1'>";
                    echo "<tr><th>School Name</th><th>Year</th><th>Total Students</th><th>Faculty Names</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['schools']}</td>";
                        echo "<td>{$row['year']}</td>";
                        echo "<td>{$row['totalStudents']}</td>";
                        echo "<td>{$row['facultyNames']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Error: " . $con->error;
                }

                // Close the prepared statement and the database connection
                $stmt->close();
                $con->close();
            }
            ?>

        </div>

        <!--<footer class="footer mt-auto py-3">-->
        <!--            <div class="container text-center">-->
        <!--                <span class="text-muted">Developed By Prahlad Singh & Kuldeep Gangwar</span>-->
        <!--            </div>-->
        <!--            </footer>-->
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>
</body>

</html>
