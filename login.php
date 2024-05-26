<?php
session_start();
error_reporting(0);

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: user_dash.php");
    }
    exit();
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Establish a database connection (replace with your actual database credentials)
    include 'database.php';

    // Securely hash the password (replace with a better hashing algorithm in production)

    // Prepare and execute a query
    $stmt = $con->prepare("SELECT id, username, role, status FROM usersss WHERE username = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($dbUserId, $dbUsername, $dbRole, $dbStatus);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Check if the user's status is active
        if ($dbStatus === 'active') {
            // Successful login
            $_SESSION['id'] = $dbUserId;
            $_SESSION['username'] = $dbUsername;
            $_SESSION['role'] = $dbRole;
            if ($dbRole === 'admin') {
                header("Location: admin.php");
            } elseif ($dbRole === 'user') {
                header("Location: user_dash.php");
            }
        } else {
            // User is inactive
            $errorMessage = "Your account is inactive. Please contact the administrator.";
        }
    } else {
        // Invalid credentials
        $errorMessage = "Invalid username, password, or role.";
    }

    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <title>KCMT's Deeksha</title>
  <link rel="icon" type="image/x-icon" href="car.png">
  <style>
 html * {
      font-family: Arial;
    }
    body {
      background-color: white;
      background:url(bg-hero.png)no-repeat fixed 50%;
      
    }
    a {
      text-decoration: none;
    }
    /* NAVBAR STYLING STARTS */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      /*padding: 20px;*/
      background-color: #ff0000;
      color: #fff;
    }
    .nav-links a {
      color: #fff;
    }
    /* LOGO */
    .logo {
      font-size: 32px;
    }
    /* NAVBAR MENU */
    .menu {
      display: flex;
      gap: 1em;
      font-size: 18px;
    }
    .menu li:hover {
      background-color: #006cd9;
      border-radius: 5px;
      transition: 0.3s ease;
    }
    .menu li {
      padding: 5px 14px;
      list-style-type: none;
    }
    /*RESPONSIVE NAVBAR MENU STARTS*/
    /* CHECKBOX HACK */
    input[type=checkbox]{
      display: none;
    } 
    /*HAMBURGER MENU*/
    .hamburger {
      display: none;
      font-size: 24px;
      user-select: none;
    }
   
    /* APPLYING MEDIA QUERIES */
    @media (max-width: 1260px) {
      .menu { 
        display:none;
        position: absolute;
        background-color:#ff0000;
        right: 0;
        /*left: 0;*/
        text-align: center;
        padding: 16px 0;
        margin-right: 8px;
      }
      .menu li:hover {
        display: inline-block;
        background-color:#4c9e9e;
        transition: 0.3s ease;
      }
      .menu li + li {
        margin-top: 12px;
      }
      input[type=checkbox]:checked ~ .menu{
        display: block;
      }
      .hamburger {
        display: block;
      }
      .dropdown {
        left: 50%;
        top: 30px;
        transform: translateX(35%);
      }
      .dropdown li:hover {
        background-color: #4c9e9e;
      }
      /* Adjust image size for smaller devices */
      .center img {
        width: 80%; /* Adjust the width as needed */
      }
    }
    .card {
       /*box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
      transition: 0.3s;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    .card:hover {
      /*box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);*/
    }
    /* Elegant Login Button */
    .login-button {
      display: block;
      width: 120px;
      padding: 10px;
      background-color: #ff0000;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      margin: 20px auto;
    }
    .login-button:hover {
      background-color: #006cd9;
    }
    /* Text Alignment */
    .typed-text {
      width: 100%; /* Adjust the width as needed */
      margin: 0 auto;
      text-align: justify;
    }
    /* Login Form Styling */
    .login-form {
      text-align: center;
      width: 60%; /* Adjust the width of the form */
      margin: auto; /* Center the form horizontally */
    }
    .login-form input[type="text"],
    .login-form input[type="password"]
     {
      width: 100%; /* Set the width of inputs to 100% */
      padding: 15px;
      margin: 15px -15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .login-form input[type="submit"] {
      background-color: #ff0000;
       width: 100%; /* Set the width of inputs to 100% */
      padding: 15px;
      margin: 15px - 15px;
      border-radius: 5px;
      color: white;
      border: none;
      
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .login-form input[type="submit"]:hover {
      background-color: #006cd9;
    }
    .login__check {
      display: flex;
      column-gap: 0.5rem;
      align-items: center;
      color: red;
      justify-content: center;
    }
    .login__check-input {
      appearance: none;
      width: 16px;
      height: 16px;
      border: 2px solid hsl(244, 4%, 36%);
      background-color: hsla(244, 16%, 92%, 0.2);
      border-radius: 0.25rem;
    }
    .login__check-input:checked {
      background: hsl(244, 75%, 57%);
    }
    .login__check-input:checked::before {
      content: "✔️";
      display: block;
      color: #fff;
      font-size: 0.75rem;
      transform: translate(1.5px, -2.5px);
    }
    .login__check-label {
      font-size: .9rem;
      color: black;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo">
      <i class='bx bxs-school bx-fade-down'></i>
      <span class="logo_name"><b>Deeksha</b></span>
    </div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="about_us.php">Team</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact_us.php">Contact</a></li>
      </div>
    </ul>
  </nav>
  <div class="card">
      <br>
    <!-- Logo -->
    <img src="kcmtlogo.png" alt="Logo" class="logo1" style="width: 130px;">
    <!-- Login Form -->
    <form class="login-form" action="" method="POST">
      <h2>KCMT's Deeksha</h2>
      <div class="login__check">
        <div>
          <input id="check1" type="radio" name="role" value="admin" required >
          <label for="check1" class="login__check-label">Administrator</label>
        </div>
        <div>
          <input id="check2" type="radio" name="role" value="user" required>
          <label for="check2" class="login__check-label">Faculty</label>
        </div>
        
      </div>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" style="-webkit-text-security: square" required><br>
      <br>
      <input type="submit" value="Login">
      <!-- Forgot Password and Signup Links -->
      <div style="margin-top: 5px;">
        <a href="forgot_password.php" style="color: #ff0000; text-decoration: none;">Forgot Password?</a>
        <span style="color: #000;"> | </span>
        <a href="signup.php" style="color: #ff0000; text-decoration: none;">Sign Up</a>
      </div>
    </form>
    <!-- Display error message in a card -->
    <?php if (!empty($errorMessage)) : ?>
      <div style="max-width: 400px; margin: 20px auto; padding: 15px; border: 1px solid red; border-radius: 5px; background-color: #ffebeb; text-align: center; color: red;">
        <?php echo htmlspecialchars($errorMessage); ?>
      </div>
    <?php endif; ?>
  </div>
  
</body>
</html>
