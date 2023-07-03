<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $index = $_POST['index'];
  $commentaryLines = explode("\n\n", file_get_contents('../waitingCommentary.txt'));
  
  // Check if the specified index exists in the commentary lines array
  if (isset($commentaryLines[$index])) {
    // Remove the commentary at the specified index
    unset($commentaryLines[$index]);

    // Reconstruct the new commentary string
    $newCommentary = implode("\n\n", $commentaryLines);

    // Update the content of the waitingCommentary.txt file with the new commentary
    file_put_contents('../waitingCommentary.txt', $newCommentary);
    
    // Redirect back to the previous page with the modal open
    $previousPage = $_SERVER['HTTP_REFERER'];
    header('Location: ' . $previousPage . '?modal-open');
    exit();
  }
}
?>
