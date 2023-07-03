<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Destination email address
    $to = "garagev.parrot@example.com";

    // Email subject
    $subject = "Nouveau message de contact";

    // Email body
    $emailBody = "Nom: $lastName\n";
    $emailBody .= "Prénom: $firstName\n";
    $emailBody .= "Adresse e-mail: $email\n";
    $emailBody .= "Numéro de téléphone: $phone\n";
    $emailBody .= "Message:\n$message";

    // Email headers
    $headers = "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Send the email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
} else {
    echo "Une erreur s'est produite lors du traitement du formulaire.";
}
?>
