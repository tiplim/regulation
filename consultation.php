<?php

session_start();
// This part checks if the form has been submitted and redirects accordingly
if (isset($_POST['go_to_index'])) {
    // Redirect to index.php
    header('Location: index.php');
    exit(); // Make sure the script stops executing after redirection
}
require_once("cnx.php");
require("header-function.php");
if(isset($_SESSION['idligne'])) 
$_SESSION['idlign'] = $_SESSION['idligne'];
$idligne = $_SESSION['idlign'];


    //récupère ligne
    $sql = "SELECT * FROM ticket WHERE idticket = ?"; // Utilisation des paramètres préparés
                    
    // Préparer et exécuter la requête
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $idligne);
    $stmt->execute();

    unset($_SESSION['idligne']);


    if ($stmt->rowCount() > 0) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        } else {

        echo "Erreur de chargement.";
        header("Location: index.php");

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="consultation.css">
    <title>Détails du Ticket</title>
</head>
<body>
    <div class="rendu">
        <div class="block">
            <div class="titre">
                
                ID du ticket :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["idticket"]);
                    
                    ?>
                </div>

    
        </div>

        <div class="block">
            <div class="titre">
                
                Date de création :

            </div>
                <div class="content">
                    <?php 
                        $formatteddate = date("d-m-Y à H\hi", strtotime($row['datecreationticket']));
                        echo $formatteddate; 
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Créé par :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["userID"]) . ", Exploitation " . htmlspecialchars($row["serviceagent"]); 
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Nom agent :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["nomAgent"]); 
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Réseau :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["reseau"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Ligne :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["ligne"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Service :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["servicevehi"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Commune :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["commune"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Sens du véhicule :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["sensvehic"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                N° de parc :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["parc"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Immatriculation :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["immatriculationvehic"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Autre immatriculation véhicule :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["autreparc"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Transporteur :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["societevehic"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Date de l'évènement :

            </div>
                <div class="content">
                    <?php 
                        $formattedevent = date("d-m-Y", strtotime($row["dateEvent"]));
                        $formattedhour = date("H\hi", strtotime($row["heure"]));
                        echo "Le " . $formattedevent . " à " . $formattedhour;
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Nature de l'incident :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["nature"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Conducteur :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["conducteur"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Détails :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["details"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Traitement :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["traitement"]);
                    
                    ?>
                </div>

    
        </div>
        <div class="block">
            <div class="titre">
                
                Diffusion :

            </div>
                <div class="content">
                    <?php 
                    
                        echo htmlspecialchars($row["diffusion"]);
                        if(htmlspecialchars($row["diffusion"])=="non"){
                            echo ', diffusé à '.htmlspecialchars($row["mail"]);
                        }
                    
                    ?>
                </div>
                <button id='export_button_consultation' class='exportcons'>Exporter vers Excel</button>
    
        </div>
       
    </div>

<form method="POST" action="">
        <button type="submit" name="go_to_index" id="retour">< Retour</button>
    </form>
    
    <table id="table_exportable_consultation" style="display:none;">
    <thead>
        <tr>
            <th>ID du ticket</th>
            <th>Date de création</th>
            <th>Créé par</th>
            <th>Nom agent</th>
            <th>Réseau</th>
            <th>Ligne</th>
            <th>Service</th>
            <th>Commune</th>
            <th>Sens du véhicule</th>
            <th>N° de parc</th>
            <th>Immatriculation</th>
            <th>Autre immatriculation véhicule</th>
            <th>Transporteur</th>
            <th>Date de l'évènement</th>
            <th>Nature de l'incident</th>
            <th>Conducteur</th>
            <th>Détails</th>
            <th>Traitement</th>
            <th>Diffusion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo htmlspecialchars($row["idticket"]); ?></td>
            <td><?php echo date("d-m-Y à H\hi", strtotime($row['datecreationticket'])); ?></td>
            <td><?php echo htmlspecialchars($row["userID"]) . ", Exploitation " . htmlspecialchars($row["serviceagent"]); ?></td>
            <td><?php echo htmlspecialchars($row["nomAgent"]); ?></td>
            <td><?php echo htmlspecialchars($row["reseau"]); ?></td>
            <td><?php echo htmlspecialchars($row["ligne"]); ?></td>
            <td><?php echo htmlspecialchars($row["servicevehi"]); ?></td>
            <td><?php echo htmlspecialchars($row["commune"]); ?></td>
            <td><?php echo htmlspecialchars($row["sensvehic"]); ?></td>
            <td><?php echo htmlspecialchars($row["parc"]); ?></td>
            <td><?php echo htmlspecialchars($row["immatriculationvehic"]); ?></td>
            <td><?php echo htmlspecialchars($row["autreparc"]); ?></td>
            <td><?php echo htmlspecialchars($row["societevehic"]); ?></td>
            <td><?php echo "Le " . date("d-m-Y", strtotime($row["dateEvent"])) . " à " . date("H\hi", strtotime($row["heure"])); ?></td>
            <td><?php echo htmlspecialchars($row["nature"]); ?></td>
            <td><?php echo htmlspecialchars($row["conducteur"]); ?></td>
            <td><?php echo htmlspecialchars($row["details"]); ?></td>
            <td><?php echo htmlspecialchars($row["traitement"]); ?></td>
            <td><?php 
                    
                    echo htmlspecialchars($row["diffusion"]);
                    if(htmlspecialchars($row["diffusion"])=="non"){
                        echo ', diffusé à '.htmlspecialchars($row["mail"]);
                    }
                
                ?></td>
        </tr>
    </tbody>
</table>
<a href="mentionslegales.php" style="text-decoration: underline; font-size:14px; text-decoration:none; color: black; position:fixed; bottom:10px;left:10px">Mentions légales</a>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
<script>
document.getElementById("export_button_consultation").addEventListener("click", function () {
	// Récupérer la variable userID PHP via JavaScript
	var userID = "<?php echo $_SESSION['userID']; ?>"; // Assurez-vous que cette variable est disponible dans la session PHP
    var idTIK = "<?php echo htmlspecialchars($row["idticket"]); ?>";

	const table_html = document.getElementById("table_exportable_consultation");

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
	XLSX.writeFile(workbook, "export_ticket_" + idTIK + "_par_" + userID + ".xlsx");
});
</script>