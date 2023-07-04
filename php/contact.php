<!-- Contact div with phone number and email address -->
<div class="contact">

    <!-- Phone number with link to call -->
    <div class="phone">
        <a class="contact-link" href="tel:02.02.02.02.02">
            <img src="../img/phone.png" alt="" width="60px" height="60px">
            <p>02.02.02.02.02</p>
        </a>
    </div>

    <!-- Email address with link to show contact form -->
    <div class="mail">
        <a class="contact-link" href="#" onclick="showContactForm()">
            <img src="../img/mail.png" alt="" width="60px" height="60px">
            <p>garagev.parrot@example.com</p>
        </a>
    </div>  
</div>

<!-- Contact form section initially hidden -->
<div class="contactForm" style="display: none;">
    <form action="sendEmail.php" method="POST">

        <!-- Input field for first name -->
        <label for="firstName">Prénom :</label>
        <input type="text" class="firstName" name="firstName" required><br>

        <!-- Input field for last name -->
        <label for="lastName">Nom :</label>
        <input type="text" class="lastName" name="lastName" required><br>

        <!-- Input field for email address -->
        <label for="email">Adresse e-mail :</label>
        <input type="email" class="email" name="email" required><br>

        <!-- Input field for phone number -->
        <label for="phone">Numéro de téléphone :</label>
        <input type="tel" class="phone" name="phone" required><br>

        <!-- Textarea for user's message -->
        <label for="message">Message :</label>
        <textarea class="message" name="message" required></textarea><br>

        <!-- Submit button to send the form data -->
        <input type="submit" value="Envoyer">
    </form>
</div>


