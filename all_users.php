<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
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
  <title>Admin Panel || Status</title>
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
    width: 40px; /* Adjust according to your design */
    height: 40px; /* Adjust according to your design */
    border-radius: 50%; /* Makes the image round */
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
   
   .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .home-section .home-content {
            position: relative;
            padding-top: 70px;
            padding-left: 10px;
            padding-right: 10px;
        }

        h1 {
            text-align: center;
            color: #ff6f61;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #ff6f61;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        @media(max-width: 768px) {
            th, td {
                font-size: 14px;
            }
            .home-section {
             width: 200%;
             left: 0;
            }
        }
        @media (max-width: 756px)
            .home-section {
             width: 200%;
             left: 0;
        }

        @media(max-width: 576px) {
            th, td {
                font-size: 12px;
            }
        }
       
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">DEEKSHA</H5>
    </div>
   <ul class="nav-links">
      <li>
        <a href="admin.php">
          <i class='bx bx-home'></i>
          <span class="links_name">Admin Dasboard</span>
        </a>
      </li>
       <li>
        <a href="analytics.php" >
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li>
       <li>
        <a href="regi_list.php" >
          <i class='bx bx-calendar-check'></i>
          <span class="links_name">Give Allotments</span>
        </a>
      </li>
      <li>
        <a href="admin_data_report.php">
          <i class='bx bx-book-alt'></i>
          <span class="links_name">Completed Allotment</span>
        </a>
      </li>
      <li>
       <a href="total_allotment.php">
           <i class='bx bx-clipboard'></i>
          <span class="links_name">Total Given Allotment</span>
        </a>
      </li>
         <li>
        <a href="reallotment.php">
                      <i class='bx bx-archive-in'></i>
          <span class="links_name">Re-allotments</span>
        </a>
      </li>
        <!--<li>
        <a href="add_users.php">
           <i class='bx bx-user-plus'></i>
          <span class="links_name">Add Faculty</span>
        </a>
      </li>-->
       <li>
        <a href="add_schools.php">
           <i class='bx bx-plus'></i>
          <span class="links_name">Add Schools</span>
        </a>
      </li>
       </li>
         <li>
        <a href="all_users.php" class="active">
                      <i class='bx bx-group'></i>
          <span class="links_name">User Status</span>
        </a>
      </li>
      <li>
        <a href="school_info.php">
           <i class='bx bx-info-circle'></i>
          <span class="links_name">School Info</span>
        </a>
      </li>
      
     
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">User Status Update</span>
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
 <div class="container">
       
             <?php
        include 'database.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST['status'] as $userId => $status) {
                $sql = "SELECT status FROM usersss WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $previousStatus = $row['status'];

                if ($previousStatus !== $status) {
                    $updateSql = "UPDATE usersss SET status = ? WHERE id = ?";
                    $updateStmt = $con->prepare($updateSql);
                    $updateStmt->bind_param("si", $status, $userId);
                    if ($updateStmt->execute()) {
                        // Status updated successfully, send email to user
                        $userSql = "SELECT username FROM usersss WHERE id = ?";
                        $userStmt = $con->prepare($userSql);
                        $userStmt->bind_param("i", $userId);
                        $userStmt->execute();
                        $userResult = $userStmt->get_result();
                        if ($userRow = $userResult->fetch_assoc()) {
                            $to = $userRow['username']; // User's email address
                            $subject = 'Status Update';
                       $message = '<html><body>';
    $message .= '<div style="font-family: Arial, sans-serif; color: #333; padding: 20px;">';
    $message .= '<h2 style="color: #800000;">Status Update</h2>';
    $message .= '<p>Your account status has been changed to <strong style="color: #008000;">' . $status . '</strong> by the Administrator.</p>';
    $message .= '<p>Thank you for using our services.</p>';
    $message .= '<p style="color: #666;">Sincerely,<br>Admin Team</p>';
    $message .= '</div></body></html>';

    // Additional headers for HTML email
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: admin@ourwebprojects.site'; // Your email address

                            // Send email
                            mail($to, $subject, $message, $headers);
                        }
                    } else {
                        echo "Error updating record: " . $con->error;
                    }
                }
            }
            echo "<script>window.location.href = window.location.href;</script>";
        }

        $sql = "SELECT id, name, department, role, username, status FROM usersss WHERE role='user'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='post'>";
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["department"] . "</td>
                        <td>" . $row["role"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>
                            <input type='radio' name='status[" . $row["id"] . "]' value='active' " . ($row["status"] == 'active' ? 'checked' : '') . " onchange='confirmStatusChange(" . $row["id"] . ", this)'> Active
                            <input type='radio' name='status[" . $row["id"] . "]' value='inactive' " . ($row["status"] == 'inactive' ? 'checked' : '') . " onchange='confirmStatusChange(" . $row["id"] . ", this)'> Inactive
                        </td>
                    </tr>";
            }
            echo "</table>";
            echo "</form>";
        } else {
            echo "0 results";
        }

        $con->close();
        ?>
    </div>

    </div>
<?php include 'footer.php';?>
  </section>
     <script>
        function confirmStatusChange(userId, radio) {
            var status = radio.value;
            if (confirm("Are you sure you want to change the status?")) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = window.location.href;
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'status[' + userId + ']';
                input.value = status;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            } else {
                var checkedRadio = document.querySelector('input[name="status[' + userId + ']"]:checked');
                if (checkedRadio) {
                    checkedRadio.checked = false;
                }
            }
        }
    </script>
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