<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'garage_v_parrot';

// Connection to the database
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $dbEmail = $_POST['emailInput'];
    $dbPassword = $_POST['passwordInput'];

    // Query to retrieve employee information
    $query = "SELECT * FROM employees WHERE email = '$dbEmail' AND password = '$dbPassword'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        session_start();

        $_SESSION['role'] = $role;

        // Redirect based on employee role
        if ($role === 'admin') {
            header("Location: ../php/admin.php");
            exit();
        } elseif ($role === 'salary') {
            header("Location: ../php/salary.php");
            exit();
        }
    } else {
        // Incorrect credentials
        header("Location: ../php/index.php");
    }
}


// Close the database connection
mysqli_close($conn);
?>