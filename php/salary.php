<?php
session_start(); // Starting the session

// Checking the user's role
if (isset($_SESSION['role']) && $_SESSION['role'] === 'salary') { 
    // Content reserved for administrators ?>
    
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="../css/styles.css">
            <title>Garage V. Parrot</title>
        </head>
        
        <body>
            <?php 
            // Importing required files
            require 'header.php';
            
            require 'article.php';
    
            require 'toSell.php';

            require 'commentary.php';
    
            require 'footer.php';
    
            require 'modal.php'; 
            
            require 'carModal.php'; 
            
            require 'commentaryModal.php'; ?>
    
            <script src="../js/main.js"></script>
        </body>
    </html>


<?php } else {
    // Redirecting if the user is not authorized
    header("Location: ../php/index.php");
    exit();
}
?>