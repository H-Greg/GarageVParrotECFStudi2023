<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the index of the comment to be validated
    $index = $_POST['index'];

    // Read the content of the waitingCommentary.txt file
    $commentaryFile = file_get_contents('../waitingCommentary.txt');
    $commentaryLines = explode("\n\n", $commentaryFile);

    // Check if the index is valid
    if (isset($commentaryLines[$index])) {
        // Retrieve comment information
        $commentaryLine = $commentaryLines[$index];
        $commentaryParts = explode("\n", $commentaryLine);
        $name = substr($commentaryParts[0], 6); // Get the name by ignoring "Name: "
        $comment = substr($commentaryParts[1], 9); // Get the comment by ignoring "Comment: "
        $rating = substr($commentaryParts[2], 8); // Get the rating by ignoring "Rating: "

        // Save the comment in the database
        $servername = "localhost";
        $username = "root";
        $dbPassword = "";
        $database = "garage_v_parrot";
        $table = "commentary";

        // Create a database connection
        $conn = new mysqli($servername, $username, $dbPassword, $database);

        // Check if the connection failed
        if ($conn->connect_error) {
            die("Database connection error:" . $conn->connect_error);
        }

        // Prepare the comment insertion query
        $stmt = $conn->prepare("INSERT INTO $table (comment, stars, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $comment, $rating, $name);

        // Execute the query to insert the comment in the database
        $stmt->execute();

        // Close the database connection
        $stmt->close();
        $conn->close();

        // Remove the comment from the waitingCommentary.txt file
        unset($commentaryLines[$index]);
        $updatedCommentary = implode("\n\n", $commentaryLines);
        file_put_contents('../waitingCommentary.txt', $updatedCommentary);

        // Redirect to the page where the modal box is located
        header('Location: commentaryModal.php?modal-open');
        exit();
    }
}
