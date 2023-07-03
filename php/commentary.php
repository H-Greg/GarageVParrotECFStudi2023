<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Check if the fields are valid (additional checks can be added)
    if (!empty($name) && !empty($comment) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        // Comment format
        $newComment = "Name: $name\nComment: $comment\nRating: $rating\n\n";

        // Add the comment to the waitingCommentary.txt file
        file_put_contents('../waitingCommentary.txt', $newComment, FILE_APPEND);    
    }
}

// Check if the user is an administrator or a staff member 
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'salary')) { ?>
        <button type="button" id="moderate-commentary" class="modify-button">Modifier</button>
<?php   } 
?>

<section class="commentary">
    <div id="comments-container">
        <?php
        // Establish the database connection
        $servername = "localhost";
        $username = "root";
        $dbPassword = "";
        $database = "garage_v_parrot";
        $table = "commentary";

        $conn = new mysqli($servername, $username, $dbPassword, $database);

        // Check if the connection has failed
        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

        // Retrieve the comments stored in the database
        $sql = "SELECT comment, stars, name FROM $table";
        $result = $conn->query($sql);

        // Check if any comments have been retrieved
        if ($result->num_rows > 0) {
            // Display each comment with the specified style
            while ($row = $result->fetch_assoc()) {
                $comment = $row["comment"];
                $stars = $row["stars"];
                $name = $row["name"];

                echo '<div class="comment">';
                echo '<span class="stars">';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $stars) {
                        echo '<span class="star-red">*</span>';
                    } else {
                        echo '<span class="star-white">*</span>';
                    }
                }
                echo '</span>';
                echo '<span class="comment-text">' . $comment . ' ' . '</span>';
                echo '<span class="comment-name">' . $name . '</span>';
                echo '</div>';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <h2>Laissez un témoignage:</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="write-comment">
        <label for="rating">Note:</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required>

        <label for="comment">Commentaire:</label>
        <textarea name="comment" id="comment"></textarea>

        <label for="name">Nom:</label>
        <input type="text" name="name" id="name" required>

        <button type="submit" id="submitCommentaryButton">Envoyer</button>
    </form>
</section>

