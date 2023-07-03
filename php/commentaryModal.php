<!-- Modal box for pending commentaries -->
<div id="commentaryModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Commentaires en attente:</h3>
    <ul id="commentaryList">
      <?php
      // Read the content of "waitingCommentary.txt" file
      $commentaryFile = file_get_contents('../waitingCommentary.txt');

      // Split the content into separate commentaries
      $commentaryLines = explode("\n\n", $commentaryFile);
      
      // Count the number of commentaries
      $commentaryCount = count($commentaryLines);

      // Iterate through each commentary
      for ($i = 0; $i < $commentaryCount - 1; $i++) {
        $commentaryLine = $commentaryLines[$i];
        $commentaryParts = explode("\n", $commentaryLine);
        $name = substr($commentaryParts[0], 6); // Extract the name by removing "Name: "
        $comment = substr($commentaryParts[1], 9); // Extract the comment by removing "Comment: "
        $rating = substr($commentaryParts[2], 8); // Extract the rating by removing "Rating: "

        // Display the name, comment, and rating for each commentary
        echo '<li class="waiting-commentary"><strong>Nom:</strong> ' . $name . '<br>';
        echo '<strong>Commentaire:</strong> ' . $comment . '<br>';
        echo '<strong>Note:</strong> ' . $rating . '</li><br>';

        // Display buttons to validate or delete each commentary
        echo '<div class="button-container">';
        echo '<form method="POST" action="validateComment.php">';
        echo '<input type="hidden" name="index" value="' . $i . '">';
        echo '<button type="submit" name="validate-button" class="moderateCommentaryButton">Valider</button>';
        echo '</form>';
        echo '<form method="POST" action="deleteComment.php">';
        echo '<input type="hidden" name="index" value="' . $i . '">';
        echo '<button type="submit" name="delete-button" class="moderateCommentaryButton">Supprimer</button>';
        echo '</form></div></li><br>';
      }
      ?>
    </ul>
  </div>
</div>

