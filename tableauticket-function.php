
</script>

<?php

function Tableauticket() {

    require("cnx.php");

    if (!isset($_SESSION['societeuser'])) {
        echo 'Vous devez être connecté';
        exit; // Stoppe l'exécution si l'utilisateur n'est pas connecté
    }

    $societe = $_SESSION['societeuser'];
    $role = $_SESSION['role'];
    $_SESSION['filtreactif'] = ''; 
    $userID = $_SESSION['userID'];
    // Préparer une partie de la requête SQL pour les filtres
    $whereConditions = [];


   





// Si un message est stocké dans la session, le montrer
$alertMessage = isset($_SESSION['alert']) ? $_SESSION['alert'] : null;
if ($alertMessage) {
    unset($_SESSION['alert']);  // Effacer l'alerte après l'avoir affichée
}

    // Filtrage par date (si date début et date fin sont fournies)
    if (isset($_POST['datedebut']) && $_POST['datedebut'] !== "" && isset($_POST['datefin']) && $_POST['datefin'] !== "") {
        $datedebut = $_POST['datedebut'];
        $datefin = $_POST['datefin']." 23:59:59";
        $whereConditions[] = "datecreationticket BETWEEN '".$datedebut."' AND '".$datefin."'";
        $formatted_datedebut = date("d/m/Y", strtotime($datedebut));
        $formatted_datefin = date("d/m/Y", strtotime($datefin));
        $_SESSION['filtreactif'] .= "Entre le ".$formatted_datedebut." et le ".$formatted_datefin;
    }

    // Filtrage par nature (si nature est sélectionnée)
    if (isset($_POST['nature']) && $_POST['nature'] !== "") {
        $nature = $_POST['nature'];
        $whereConditions[] = "nature = '".$nature."'";
        $_SESSION['filtreactif'] .= ($_SESSION['filtreactif'] ? " <br> " : "") . "Nature : '".$nature."'";
    }

    // Filtrage par conducteur (si conducteur est sélectionné)
    if (isset($_POST['conducteur']) && $_POST['conducteur'] !== "") {
        $conducteur = $_POST['conducteur'];
        $whereConditions[] = "conducteur = '".$conducteur."'";
        $_SESSION['filtreactif'] .= ($_SESSION['filtreactif'] ? " <br> " : "") . "Conducteur : '".$conducteur."'";
    }
    if ($role == 0 OR $role == 'o') {
        $whereConditions[] = "usersociete.userID = ?";
        
    }
    // Construire la requête de base
    $sql = "SELECT * FROM ticket";

    if ($role == 0 OR $role == 'o') {
        $sql .= " INNER JOIN societe on societe.nom = ticket.serviceagent INNER JOIN usersociete on usersociete.societeID = societe.id";
    }
    // Ajouter les conditions WHERE si des filtres sont appliqués
    if (count($whereConditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $whereConditions);
    }



    // Tri par date - par défaut, trier par ordre décroissant
    if (isset($_POST['plusrecent'])) {
        $sql .= " ORDER BY datecreationticket ASC";  // Tri par ordre croissant (plus récent)
        $_SESSION['filtreactif'] .= ($_SESSION['filtreactif'] ? " <br> " : "") . "Trié par date, ordre croissant";
    } elseif (isset($_POST['plusancien'])) {
        $sql .= " ORDER BY datecreationticket DESC";  // Tri par ordre décroissant (plus ancien)
        $_SESSION['filtreactif'] .= ($_SESSION['filtreactif'] ? " <br> " : "") . "Trié par date, ordre décroissant";
    } else {
        // Si aucun tri n'est spécifié, ordre par défaut : décroissant
        $sql .= " ORDER BY datecreationticket DESC";
        
    }

    // Préparer et exécuter la requête SQL
    $stmt = $conn->prepare($sql);
    if ($role == 0 OR $role == 'o') {
        $stmt->BindParam(1, $userID);
    }
    $stmt->execute();

    
    // Affichage des résultats
    if ($stmt->rowCount() > 0) {

        $count_row = $stmt->rowCount();
        echo "<div class='table-container'>";
        echo "<table id='table_exportable'>";
        echo "<tr>";
        echo "<th>Date de création</th>";
        echo "<th>Réseau</th>";
        echo "<th>Ligne</th>";
        echo "<th>Nature</th>";
        echo "<th>Transporteur</th>";
        echo "<th>Matricule</th>";
        echo "<th>Détails</th>";
        echo "</tr>";

        echo "<tr class='filtrestable'><td>" . $count_row . " résultat(s)" . "<br>" . $_SESSION['filtreactif'] . "</td></tr>";

        // Affichage des tickets
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $formatted_date_crea = date("d/m/Y H\hi", strtotime($row['datecreationticket']));
            $matricule = !empty(htmlspecialchars($row['immatriculationvehic'])) ? htmlspecialchars($row['immatriculationvehic']) : (!empty(htmlspecialchars($row['parc'])) ? htmlspecialchars($row['parc']) : htmlspecialchars($row['autreparc']));
            
            echo "<tr onclick='submitForm(" . $row['idticket'] . ")'>
            <td>" . $formatted_date_crea . "</td>
            <td>" . htmlspecialchars($row["reseau"]) . "</td>
            <td>" . htmlspecialchars($row["ligne"]) . "</td>
            <td>" . htmlspecialchars($row["nature"]) . "</td>
            <td>" . htmlspecialchars($row["societevehic"]) . "</td>
            <td>" . $matricule . "</td>
            <td>" . htmlspecialchars($row["details"]) . "<form method='POST' action='' id='form_" . $row['idticket'] . "'><input type='hidden' name='consulter' value='" . $row['idticket'] ."'></form></td>
          </tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "Aucun ticket trouvé.";
    }
}

?>
<script>
    function submitForm(ticketId) {
        // Sélectionner le formulaire associé au ticket et le soumettre
        var form = document.getElementById('form_' + ticketId);
        form.submit();  // Soumet le formulaire via JavaScript
    }
</script>