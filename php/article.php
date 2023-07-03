<?php

// Check if the administrator is logged in
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Check if the modification form has been submitted
    if (isset($_POST['modifiedArticle'])) {
        $modifiedContent = $_POST['modifiedArticle'];

        // Check if the content has been modified
        if ($modifiedContent !== getOriginalContent()) {
            // Open the file in "w" mode to overwrite the existing content
            $file = fopen('../savedArticle.txt', 'w');

            // Save the modified content to the file
            fwrite($file, $modifiedContent);

            // Close the file
            fclose($file);
        }

        // Redirect the administrator to the article page
        header('Location: admin.php');
        exit();
    }
}

// Function to retrieve the original content from the "savedArticle.txt" file
function getOriginalContent()
{
    $content = file_get_contents('../savedArticle.txt');
    return $content;
}

// Function to retrieve the article content from the "savedArticle.txt" file with preserved line breaks and tabs
function getArticleContent()
{
    $content = getOriginalContent();
    $content = nl2br(htmlspecialchars($content));
    return $content;
}

// Function to retrieve the original content from the "savedArticle.txt" file without escaping
function getOriginalContentDecoded()
{
    $content = file_get_contents('../savedArticle.txt');
    $content = htmlspecialchars_decode($content);
    return $content;
}

// If the administrator is logged in, display the modify button
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    echo '<button type="button" class="modify-button modify-article">Mofifier</button>'; // Display the modify button
}
?>

<article>
    <form id="modifyArticle" method="post" style="display:none;">
        <textarea name="modifiedArticle" id="textareaArticle" rows="10" cols="50"><?php echo htmlspecialchars(getOriginalContentDecoded()); ?></textarea>
        <button type="submit">Sauvegarder</button> <!-- Submit button to save the modified content -->
    </form>
    <p id="article"><?php echo getArticleContent(); ?></p>

    <?php require 'contact.php'; ?>
</article>
