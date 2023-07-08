<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS garage_v_parrot";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    echo "Error while creating the database:<br>" . $conn->error;
}

// Select the database
$conn->select_db("garage_v_parrot");

// Create the employees table
$sql = "CREATE TABLE IF NOT EXISTS employees (
    id CHAR(36) PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'employees' created successfully.<br>";
} else {
    echo "Error while creating the 'employees' table:<br>" . $conn->error;
}

// Generate a random ID
$id = uniqid();

// Admin data
$email = "vincentparrot@example.com";
$userPassword = generatePassword();
$role = "admin";

// Insert the employee into the table if not already exists
$sql = "INSERT INTO employees (id, email, password, role)
        SELECT '$id', '$email', '$userPassword', '$role'
        FROM dual
        WHERE NOT EXISTS (SELECT 1 FROM employees WHERE id = '$id'
        UNION
        SELECT 1 FROM employees WHERE email = '$email'
        )";

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        echo "Employee created successfully.<br>";
    } else {
        echo "This employee already exists.<br>";
    }
} else {
    echo "Error while creating the employee:<br>" . $conn->error;
}

// Create the cars table
$sql = "CREATE TABLE IF NOT EXISTS cars (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50),
    year INT(4),
    price VARCHAR(10),
    mileage VARCHAR(20),
    image VARCHAR(255)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'cars' created successfully.<br>";
} else {
    echo "Error while creating the table:<br>" . mysqli_error($conn);
}

// Create the commentary table
$sql = "CREATE TABLE IF NOT EXISTS commentary (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(255),
    stars INT(5),
    name VARCHAR(25)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'comments' created successfully.";
} else {
    echo "Error while creating the table:" . mysqli_error($conn);
}

// Close the connection
$conn->close();

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