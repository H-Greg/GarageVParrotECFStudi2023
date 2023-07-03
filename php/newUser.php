<?php
$servername = "localhost";
$username = "root";
$dbPassword = "";
$database = "garage_v_parrot";
$table ="employees";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the form
    $email = $_POST['email'];

    // Generate a random password
    $password = generatePassword();

    // Generate a random ID
    $id = uniqid();

    // Default role (salary)
    $role = 'salary';

    // Connect to the database
    $conn = new mysqli($servername, $username, $dbPassword, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO $table (id, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $email, $password, $role);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

// Function to generate a random password
function generatePassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

?>