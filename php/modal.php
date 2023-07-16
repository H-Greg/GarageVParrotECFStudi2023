<div id="modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      
      <!-- If the user is not logged in -->
      <?php if (!isset($_SESSION['role'])) { ?>
      <p>Si vous n'êtes pas employé dans le Garage V. Parrot, veuillez fermer cette boîte de connexion.</p>
      
      <!-- Login form -->
      <form id="loginForm" action="connexion.php" method="POST">
        <input type="email" class="email-input" id="email" name="emailInput" placeholder="Adresse e-mail" required>
        <input type="password" class="password-input" id="password" name="passwordInput" placeholder="Mot de passe" required>
        <button type="submit" class="submit-button">Se connecter</button>
        </form>
        
      <?php } ?>
      
      <!-- If the user is logged in and has admin or salary role -->
      <?php
          if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'salary')) { ?>
            <button class="submit-button"><a href="../php/logout.php">Se déconnecter</a></button>
<?php     }     
          

          // If the user is logged in and has admin role
          if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
            <form id="newUserForm" action="newUser.php" method="POST">
            <input type="email" class="email-input" id="email" name="email" placeholder="Adresse e-mail" required>
            <button class="submit-button">Ajouter un nouvel utilisateur</button>
            </form>
<?php     } ?>

<!-- Success message for new user -->
<?php if (isset($_GET['userAdded']) && $_GET['userAdded'] === 'true') { ?>
            <p>L'utilisateur '<?php echo $_GET['email']; ?>', '<?php echo $_GET['password']; ?>' a été ajouté avec succès.</p>
        <?php } ?>

    </div>
</div>
