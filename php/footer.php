<?php

// Check if the administrator is logged in
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Check if the modification form has been submitted
    if (isset($_POST['modifiedHours'])) {
        $modifiedHoursContent = $_POST['modifiedHours'];

        // Check if the content has been modified
        if ($modifiedHoursContent !== getOriginalHoursContent()) {
            // Open the file in "w" mode to overwrite the existing content
            $file = fopen('../savedHours.txt', 'w');

            // Save the modified content to the file
            fwrite($file, $modifiedHoursContent);

            // Close the file
            fclose($file);
        }

        // Redirect the administrator to the admin page
        ?><script>window.location.href = 'admin.php';</script><?php      
        exit();
    }
}

// Function to retrieve the original content of the "savedArticle.txt" file
function getOriginalHoursContent()
{
    $content = file_get_contents('../savedHours.txt');
    return $content;
}

// Function to retrieve the content of the "savedArticle.txt" file with preserved line breaks and tabulations
function getHoursContent()
{
    $content = getOriginalHoursContent();
    $content = nl2br(htmlspecialchars($content));
    return $content;
}



// Function to retrieve the original content of the "savedArticle.txt" file without escaping
function getOriginalHoursContentDecoded()
{
    $content = file_get_contents('../savedHours.txt');
    $content = htmlspecialchars_decode($content);
    return $content;
}

// If the administrator is logged in, display the modification button
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
            <button type="submit" class="modify-button modify-hours">Modifier</button>
<?php   } ?>

<footer>
    <form id="modifyHours" method="post" style="display:none;">
        <textarea name="modifiedHours" id="textareaHours" rows="10" cols="50"><?php echo htmlspecialchars(getOriginalHoursContentDecoded()); ?></textarea>
        <button type="submit">Enregistrer</button>
    </form>
    <p id="hours"><?php echo getHoursContent(); ?></p>

    <div class="contact contact-footer">
        <div class="phone">
            <a class ="contact-link" href="tel:02.02.02.02.02">
                <img src="../img/phone.png" alt="" width="60px" height="60px">
                <p>02.02.02.02.02</p>
            </a>
        </div>
        
        <div class="mail">
        <a class="contact-link" href="#" onclick="showContactForm()">
            <img src="../img/mail.png" alt="" width="60px" height="60px">
            <p>garagev.parrot@example.com</p>
        </a>
    </div>  
        
        <div class="contactForm" style="display: none;">
    <form action="send_email.php" method="POST">
        <label for="firstName">Prénom :</label>
        <input type="text" class="firstName" name="firstName" required><br>

        <label for="lastName">Nom :</label>
        <input type="text" class="lastName" name="lastName" required><br>

        <label for="email">Adresse e-mail :</label>
        <input type="email" class="email" name="email" required><br>

        <label for="phone">Numéro de téléphone :</label>
        <input type="tel" class="phone" name="phone" required><br>

        <label for="message">Message :</label>
        <textarea class="message" name="message" required></textarea><br>

        <input type="submit" value="Envoyer">
    </form>
</div>

        <div class="network">
            <a href="https://facebook.com/" target="_blank"><img src="../img/logoFacebook.png" alt="" width="50px" height="50px"></a>
            <a href="https://twitter.com/" target="_blank"><img src="../img/logoTwitter.png" alt="" width="50px" height="50px"></a>
            <a href="https://www.linkedin.com/" target="_blank"><img src="../img/logoLinkedin.png" alt="" width="50px" height="50px"></a>
        </div>
    </div>
        </footer>

<script>
    // When the administrator clicks the "Modify" button
    document.querySelector('.modify-hours').addEventListener('click', function() {
    document.getElementById('modifyHours').style.display = 'block';
    document.getElementById('hours').style.display = 'none';
});
</script>

<script>
    // Handle the Tab key press event in the text area
    document.getElementById("textareaHours").addEventListener("keydown", function(e) {
        if (e.key === "Tab") {
            e.preventDefault(); // Prevent the default behavior (focus change)
            var start = this.selectionStart;
            var end = this.selectionEnd;
            // Insert a tab at the current cursor position
            this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);
            // Move the cursor after the tab
            this.selectionStart = this.selectionEnd = start + 1;
        }
    });
</script>
