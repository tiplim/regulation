<?php
session_start();
$redirectUrl = 'login.php';

// Vérification de la session utilisateur
if (!isset($_SESSION['userID'])) {
    header("Location: $redirectUrl");
    exit();
}
// Redirection vers la page de consultation
if (isset($_POST['consulter'])) {
    // Sécuriser l'ID en échappant les caractères spéciaux
    $_SESSION["idligne"] = (int)$_POST['consulter'];  // Assurer qu'il s'agit d'un entier
    header("Location: consultation.php");
    exit;
}
// Vérifier si le paramètre 'success' existe dans l'URL
$successMessage = isset($_GET['success']) && $_GET['success'] == 'true' ? true : false;

// Gérer la session pour l'alerte
if ($successMessage) {
    $_SESSION['alert'] = 'Envoyé';  // Enregistrer le message dans la session
    header("Location: index.php");  // Rediriger pour éviter de répéter le message
    exit;
}




require_once("tableauticket-function.php");
require("cnx.php");

if($role ='o' OR $role =0) {
        $userID = $_SESSION['userID'];
        $getconducteur = "SELECT DISTINCT conducteur FROM ticket INNER JOIN societe on societe.nom = ticket.serviceagent INNER JOIN usersociete on usersociete.societeID = societe.id WHERE usersociete.userID = ?";
        $stmt = $conn->prepare($getconducteur);
        $stmt->BindParam(1, $userID);
        $stmt->execute();
        try {
            $conducteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

        $getnaturefilter = "SELECT DISTINCT nature FROM ticket INNER JOIN societe on societe.nom = ticket.serviceagent INNER JOIN usersociete on usersociete.societeID = societe.id WHERE usersociete.userID = ?";
        $stmt = $conn->prepare($getnaturefilter);
        $stmt->BindParam(1, $userID);
        $stmt->execute();
        try {
            $naturefilter = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
   } else {

        $userID = $_SESSION['userID'];

        $getconducteur = "SELECT DISTINCT conducteur FROM ticket";
        $stmt = $conn->prepare($getconducteur);
        $stmt->execute();
        try {
            $conducteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }

        $getnaturefilter = "SELECT DISTINCT nature FROM ticket";
        $stmt = $conn->prepare($getnaturefilter);
        $stmt->execute();
        try {
            $naturefilter = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }


   }

?>
<script>
    // Affichage de l'alerte JavaScript
    <?php if ($alertMessage): ?>
        window.onload = function() {
            showNotification('<?php echo $alertMessage; ?>');
        };
    <?php endif; ?>
</script>
<script>
    function showNotification(message) {
        // Créer la div pour la notification
        var notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerText = message;

        // Ajouter la notification au body
        document.body.appendChild(notification);

        // Appliquer la classe pour afficher la notification
        setTimeout(function() {
            notification.classList.add('show');
        }, 100);

        // Faire disparaître la notification après 5 secondes
        setTimeout(function() {
            notification.classList.remove('show');
            // Supprimer la notification après l'animation
            setTimeout(function() {
                notification.remove();
            }, 500);
        }, 5000); // La notification disparaît après 5 secondes
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tableauticket-function.css">
    <title>REGULATION</title>

    <script>
        // Vérification des dates en JavaScript avant la soumission du formulaire
        function validateForm() {
            var datedebut = document.getElementById('datedebut').value;
            var datefin = document.getElementById('datefin').value;

            // Vérifier si datefin est avant datedebut
            if (datedebut && datefin && datefin < datedebut) {
                alert("La date de fin doit être supérieure ou égale à la date de début.");
                return false; // Empêche l'envoi du formulaire
            }
            return true; // Permet l'envoi du formulaire
        }
    </script>

</head>

<body>

    <?php
    require("header-function.php");

        echo "<div class='container'>
        <form method='POST' action='' onsubmit='return validateForm()'>
            <div class='menu-filtre'>
                <div class='trier'>
                    <h4 style='margin:0;'>TRIER:</h4><br>
                    <button name='plusancien' style='border:none; border-radius: 5px; margin:2px' ".(isset($_POST['plusancien']) ? 'disabled' : '').">Plus récent</button>
                    <button name='plusrecent' style='border:none; border-radius: 5px; margin:2px' ".(isset($_POST['plusrecent']) ? 'disabled' : '').">Plus ancien</button>
                </div>
                <br>
                <div class='filtres'>
                    <h4 style='margin:0;'>FILTRER:</h4><br>
                    Nature:
                    <select name='nature' id='nature'>
                        <option value=''></option>";

                    foreach ($naturefilter as $row) {
                        $nature = htmlspecialchars($row['nature']);
                        echo '<option value="'.$nature.'" '.(isset($_POST['nature']) && $_POST['nature'] == $nature ? 'selected' : '').'>'.$nature.'</option>';
                    }

                    echo "</select><br><br>
                    <div class='periode'>
                    Période: <br><br>
                        <input type='date' name='datedebut' id='datedebut' value='".(isset($_POST['datedebut']) ? htmlspecialchars($_POST['datedebut']) : '')."'>
                        <br>
                            à 
                        <br><br>
                        <input type='date' name='datefin' id='datefin' value='".(isset($_POST['datefin']) ? htmlspecialchars($_POST['datefin']) : '')."'>
                    </div><br>
                    Nom conducteur:<br>
                    <select name='conducteur' id='conducteur'>
                        <option value=''></option>";
                        
                        foreach ($conducteurs as $row) {
                            if (!empty($row['conducteur'])) {  // Vérifier si 'conducteur' n'est pas vide
                                $conducteur = htmlspecialchars($row['conducteur']);
                                echo '<option value="' . $conducteur . '" ' . (isset($_POST['conducteur']) && $_POST['conducteur'] == $conducteur ? 'selected' : '') . '>' . $conducteur . '</option>';
                            }
                        }
                    echo "</select><br><br>
                    <button name='filtrer'>Filtrer</button>
                    </form>
                    <form>
                    <div class='menu-filtre'>
                    <button name='removeperiode'>Retirer les filtres</button>
                    </div>
                    </form>
                    <button id='export_button'>Exporter vers Excel</button>
                </div>
            </div>";
    ?>

    <div class="tablecontainer">
        <?php
        Tableauticket();
        ?>
    </div>
</div>
<a href="mentionslegales.php" style="text-decoration: underline; font-size:14px; text-decoration:none; color: black; position:fixed; bottom:10px;left:10px">Mentions légales</a>
</body>



</html>

<script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
<script>
document.getElementById("export_button").addEventListener("click", function () {
	// Récupérer la variable userID PHP via JavaScript
	var userID = "<?php echo $_SESSION['userID']; ?>"; // Assurez-vous que cette variable est disponible dans la session PHP

	const table_html = document.getElementById("table_exportable");

	// Créer une feuille de calcul à partir de la table HTML
	const workbook = XLSX.utils.table_to_book(table_html);

	// Ajuster les heures si nécessaire
	const sheet = workbook.Sheets[workbook.SheetNames[0]];

	// Si vous avez des colonnes contenant des dates/heure, vous devez ajuster chaque valeur.
	// Par exemple, ajuster les dates dans la première colonne (colonne A, index 0)
	for (let row = 1; row <= sheet['!rows'].length; row++) {
		const cell = sheet[`A${row}`]; // Changez "A" pour la colonne contenant vos heures
		if (cell && cell.t === 'n' && cell.v instanceof Date) {
			// Ajustez l'heure (par exemple, en ajoutant 4 heures)
			cell.v.setHours(cell.v.getHours() + 4); // Ajouter 4 heures pour le fuseau horaire
		}
	}

	// Déclencher le téléchargement du fichier Excel
	XLSX.writeFile(workbook, "export_de_" + userID + ".xlsx");
});
</script>
