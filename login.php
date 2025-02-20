<?php 
session_start(); // Démarrer la session
require_once('cnx.php'); // Connexion à la base de données
$redirectUrl = 'index.php';
if(isset($_SESSION['userID'])){
    header("Location: $redirectUrl");
    exit();
};

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupérer les valeurs envoyées par le formulaire
    $username = $_POST['fname'];  // Identifiant de l'utilisateur
    $password = $_POST['password'];  // Mot de passe de l'utilisateur

    // Validation de base
    if (!empty($username) && !empty($password)) {
        // Préparer la requête SQL pour récupérer l'utilisateur par son nom d'utilisateur
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");

        // Lier le paramètre
        $stmt->bindParam(1, $username);
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        if ($stmt->rowCount() > 0) {
            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le mot de passe est correct (en utilisant password_verify) Bycript
            if (password_verify($password, $user['password'])) {
                // Mot de passe valide, démarrer la session et rediriger
                $_SESSION['userID'] = $user['id'];  // Stocker le nom d'utilisateur  
                $_SESSION['societeuser'] = $user['societe'];  // Stocker la societe de l'utilisateur  
                $_SESSION['role'] = $user['role'];  // statut role 1 ou 0 ou 2 a
                header('Location: index.php');   // Rediriger vers la page d'accueil
                exit();
            } else {
                // Mot de passe incorrect
                $erreur = "Identifiant ou mot de passe incorrect.";
            }
        } else {
            // L'utilisateur n'existe pas
            $erreur = "Identifiant ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Connexion</title>
</head>
    <body>
        <div class='box'>
            
            <div class="title"><h2>Régulation</h2></div>
            <div class="bodycon">
                <form action="login.php" method="POST">
                <label for="id"><h4 style="margin:0">Identifiant:</h4></label>
                <input type="text" id="id" name="fname" required>
                
                <br><br>

                <label for="password"><h4 style="margin:0">Mot de passe:</h4></label>
                

                <input type="password" id="password" name="password" required>
                
                <br><br>

                <button type="submit" name="Connexion">Connexion</button><br>
                <?php if(isset($erreur)){ echo $erreur; } ?>
            </form>
            </div>
        </div>
        
    </body>
</html>