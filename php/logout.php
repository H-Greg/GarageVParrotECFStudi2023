<!-- PHP script to log out the user -->
<?php
session_start();

// Destroy all session variables
session_destroy();

// Redirect to the login page
header("Location: ../php/index.php");
exit();
?>