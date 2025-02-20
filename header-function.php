<?php 
                            // Exemple d'utilisation
                            if (isset($_POST['deconnexion'])) {
                                deconnexion(); // Redirige vers 'login.php' après déconnexion
                            }
?>
<head>
    <link rel="stylesheet" href="header.css">
</head>
<header>
    <div class="link">
        <a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Accueil</a>
        <a style="position:absolute; top: 5px; left:46.5%; border-radius:10px;background:rgb(241, 207, 164)" href="creer-un-ticket.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'creer-un-ticket.php') ? 'active' : ''; ?>">Nouvel Incident</a>

        <?php 
        if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
            echo "<a href='admin.php' class='" . (basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : '') . "'>Admin</a>";
        }
        ?>
    </div>

    <!-- Deconnexion -->
    <div class="deconnexion-container">
        <?php 
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            echo "<div class='conname'>Connecté en tant que " . $userID . "</div>";
            $buttonname = 'Deconnexion';
        } else {
            $buttonname = 'Connexion';
        }
                            // Fonction pour déconnecter l'utilisateur
                            function deconnexion($redirectUrl = 'login.php') {
                                header("Location: $redirectUrl");
                                session_unset();
                                session_destroy();
                                exit();
                            }
        ?>
        <form method="POST" action="">
            <button type="submit" name="deconnexion" class="deconn-button"><?php echo $buttonname ?></button>
        </form>
    </div>
</header>
</html>