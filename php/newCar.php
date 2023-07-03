<?php
$servername = "localhost";
$username = "root";
$dbPassword = "";
$database = "garage_v_parrot";
$table = "cars";
$uploadDirectory = "../uploads/";

// Connect to the database
$conn = new mysqli($servername, $username, $dbPassword, $database);

// Check if the connection failed
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Check if the form has been submitted
if (isset($_POST['addCar'])) {
    // Get the form values
    $brand = $_POST['brand'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $mileage = $_POST['mileage'];
    $image = $_FILES['image']['tmp_name'];

    // Check if the upload directory exists, if not, create it
    if (!file_exists($uploadDirectory) && !is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Generate a unique filename to avoid conflicts
    $filename = uniqid() . '_' . $_FILES['image']['name'];
    $destination = $uploadDirectory . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        // The file has been successfully moved, you can then save the file path in the database
        // Prepare the insert query
        $sql = "INSERT INTO $table (brand, year, price, mileage, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $brand, $year, $price, $mileage, $destination);

        // Execute the insert query
        if ($stmt->execute()) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la voiture : " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // An error occurred while moving the file
        echo "Erreur lors du téléchargement du fichier.";
    }

    // Close the connection
    $conn->close();
}