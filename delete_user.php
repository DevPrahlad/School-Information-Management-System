<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    include 'database.php';

    // Perform the delete query
    $sql = "DELETE FROM usersss WHERE id = $userId";
    if ($con->query($sql) === TRUE) {
        // Redirect back to the page after successful deletion
        header("Location: regi_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $con->close();
}
?>
