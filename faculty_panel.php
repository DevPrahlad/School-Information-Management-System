<?php
session_start();

include 'database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}
// Get the user ID from the session
$loggedInUserID = $_SESSION['id'];

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $requestedUserID = $_GET['id'];

    // Query the database to check if the logged-in user has access to the requested user ID
    $checkAccessQuery = "SELECT * FROM faculty_data WHERE id = $requestedUserID AND user_id = $loggedInUserID";
    $result = $con->query($checkAccessQuery);

    // If the result is empty, it means no access
    if ($result->num_rows === 0) {
        // Redirect to a page indicating no access
             echo '<script>alert("You do not have access to this user ID.");</script>';

        exit();
    }
} else {
    // Redirect to a page indicating invalid user ID
        echo '<script>alert("Invalid user ID.");</script>';

    exit();
}

$userID = $_SESSION['id'];
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photoPath = $uploadFile;
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
       
    }

    $user_id = $_SESSION['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $tsdate = $_POST['tsdate'];
    $tedate = $_POST['tedate'];
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
    $region = $_POST['region'];
    

    $sql = "INSERT INTO faculty_fill_data (user_id, name, department,  tsdate, tedate, schools, date, pname, pcont, tgtname, tgtcont, pgtname, pgtcont, school_status, stream, twelve, topic_covered, visit_remark, data_collected,region, photo_path) VALUES ('$user_id', '$name', '$department', '$tsdate', '$tedate', '$schools', '$date', '$pname', '$pcont', '$tgtname', '$tgtcont', '$pgtname', '$pgtcont', '$school_status', '$stream', '$twelve', '$topic_covered', '$visit_remark', '$data_collected','$region','$photoPath')";

    if ($con->query($sql) === TRUE) {
        $updateStatusSql = "UPDATE faculty_data SET status = 'Completed' WHERE id = $id AND user_id = $user_id";
        if ($con->query($updateStatusSql) === TRUE) {
            header("Location: given_allotments.php");
            exit();
        } else {
            echo "Error updating status: " . $con->error;
        }
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Panel || Fill Allotment</title>
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

   
   
    .form-group {
      margin: 15px;
    }

    .head {
      position: relative;
      font-size: 30px;
      font-weight: 600;
      color: #333;
      margin: 15px;
      align-items: center;
    }



    .head::before {
      content: "";
      position: relative;
      left: 0;
      bottom: -2px;
      height: 3px;
      width: 50px;
      border-radius: 8px;
      background-color: #4070f4;
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 45px;
      max-width: 200px;
      width: 100%;
      border: none;
      outline: none;
      color: #fff;
      border-radius: 5px;
      margin: 25px 10px;
      background-color: #FF4842;
      transition: all 0.3s linear;
      cursor: pointer;
    }

   #photo-preview {
      width: 200px;
      height: 200px;
      border: 1px solid black;
      margin-top: 10px;
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
        <a href="user_dash.php" >
          <i class='bx bx-id-card'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
        <li>
        <a href="analytics_user.php">
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li>
      <li>
        <a href="given_allotments.php" class="active">
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
        <span class="dashboard">Fill Allotment</span>
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
    <?php
        include 'database.php'; // Include the database connection

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Query to fetch a specific user's data
          $sql = "SELECT faculty_data.*, regions.region_name
        FROM faculty_data
        LEFT JOIN regions ON faculty_data.region_id = regions.region_id
        WHERE faculty_data.id = $id";
            $result = $con->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">

          <div class="row">
		  <div class="col-md-3">
              <div class="form-group">
                <label for="name">UID:</label>
                <input type="text" id="name" name="id" value="<?php echo $row["user_id"]; ?>" class="form-control" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Faculty Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row["name"]; ?>" class="form-control" readonly>
              </div> 
            </div>

            

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Department:</label>
               <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>"class="form-control" readonly>
              </div>
            </div>
			  <div class="col-md-3">
              <div class="form-group">
                <label for="name">Target Start Date:</label>
                <input type="text" id="tsdate" value="<?php echo $row['tsdate']; ?> "name="tsdate" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="email">Target End Date:</label>
                <input type="text" id="tedate" name="tedate" value="<?php echo $row['tedate']; ?>" class="form-control"readonly>
              </div>
            </div>
             <div class="col-md-4">
              <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" id="region" name="region" value="<?php echo $row['region_name']; ?>" class="form-control"readonly>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="alloted">Alloted School:</label>
                <input type="text" id="schools" name="schools" value="<?php echo $row['schools']; ?>" class="form-control"readonly>
              </div>
            </div>
				
            <div class="col-md-3">
                <div class="form-group">
                <label for="name">Date:</label>
                <input type="date" id="date" name="date" class="form-control" onchange="validateDate()">
                <small id="dateError" style="color: red;"></small>
                </div>
            </div>

          </div>
 
          <div class="row">
		
         
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Principal Name:</label>
                <input type="text" id="pname" name="pname" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Principal's Contact No.:</label>
                    <input type="tel" id="pcont" name="pcont" class="form-control" pattern="[0-9]{10}" title="Enter a valid 10-digit phone number">
                    <!-- Display error message for invalid input -->
                    <small id="pcontError" style="color: red;"></small>
                </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">TGT Teacher Name:</label>
                <input type="text" id="tgtname" name="tgtname" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">TGT Teacher's Contact No.:</label>
                    <input type="tel" id="tgtcont" name="tgtcont" class="form-control" 
                    pattern="[0-9]{10}" title="Enter a valid 10-digit phone number">
                    <!-- Display error message for invalid input -->
                    <small id="tgtcontError" style="color: red;"></small>
                </div>
            </div>
            

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">PGT Teacher Name:</label>
                <input type="text" id="pgtname" name="pgtname" class="form-control">
              </div>
            </div>

            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">PGT Teacher's Contact No.:</label>
                    <input type="tel" id="pgtcont" name="pgtcont" class="form-control" 
                    pattern="[0-9]{10}" title="Enter a valid 10-digit phone number">
                    <!-- Display error message for invalid input -->
                    <small id="pgtcontError" style="color: red;"></small>
                </div>
            </div>


       
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">School Status:</label>
                <Select name="school_status" class="form-control">
                    <option value="U.P. BOARD">U.P. BOARD</option>
            <option value="CBSE Board">CBSE Board</option>
            <option value="ICSE Board">ICSE Board</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Stream:</label>
<Select name="stream" class="form-control">
                    <option value="PCM">PCM</option>
            <option value="PCB">PCB</option>
            <option value="Commerce">Commerce</option>
                </select>              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">No. Of Students:</label>
                <input type="text" id="twelve" name="twelve" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Topic Covered:</label>
                <input type="text" id="topic" name="topic_covered" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Visit Remarks:</label>
                <input type="text" id="visistremark" name="visit_remark" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Data Collected:</label>
                <Select name="data_collected" class="form-control">
                    <option value="Yes">Yes</option>
            <option value="No">No</option>
                </select>
              </div>
            </div>


          
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="photo">Upload Photo:</label>
                <input type="file" id="photo" name="photo" class="form-control-file"  onchange="previewPhoto()" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              
                <img id="photo-preview" src="" alt="Photo Preview" class="img-thumbnail">
              </div>
            </div>
            </div>
		   <input type="submit" value="Submit" class="btn">
        </div>

      </form>
    <?php 
            } else {
                echo "User not found.";
            }
        } else {
            echo "Invalid user ID.";
        }

        $con->close();
        ?>
    </div>
<?php include 'footer.php';?>
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

 function previewPhoto() {
      var input = document.getElementById('photo');
      var preview = document.getElementById('photo-preview');

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          preview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    //Date validation
    function validateDate() {
    let startDate = new Date('<?php echo $row['tsdate']; ?>');
    let endDate = new Date('<?php echo $row['tedate']; ?>');
    let selectedDate = new Date(document.getElementById('date').value);

    let dateError = document.getElementById('dateError');

    if (selectedDate < startDate || selectedDate > endDate) {
        dateError.innerText = 'Date must be between target start date and target end date.';
        document.getElementById('date').value = ''; // Reset the date input
    } else {
        dateError.innerText = '';
    }
}

    // Mobile number validation
    // Add an event listener to validate contact numbers on input
    document.getElementById('pcont').addEventListener('input', validateContactNumber);
    document.getElementById('tgtcont').addEventListener('input', validateContactNumber);
    document.getElementById('pgtcont').addEventListener('input', validateContactNumber);

    // Function to validate contact numbers
    function validateContactNumber() {
        let contactNumber = this.value;
        let errorElement = document.getElementById(`${this.id}Error`);

        // Use a regular expression to check for a valid 10-digit phone number
        if (/^[0-9]{10}$/.test(contactNumber)) {
            errorElement.innerText = '';
        } else {
            errorElement.innerText = 'Enter a valid 10-digit phone number.';
        }
    }
  </script>
</body>

</html>