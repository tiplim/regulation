
<?php
    session_start();
    require("header-function.php");
    $redirectUrl = 'login.php';
    if(!isset($_SESSION['userID'])){
        header("Location: $redirectUrl");
    exit();
};

    require_once("cnx.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//email diffusion
if ($diffusion == "oui") {
    $userID = $_SESSION['userID'] ?? '';
    // Récupère la liste des emails de la société
    $getmail = "SELECT email FROM emails 
                INNER JOIN societe ON emails.societeID = societe.id 
                INNER JOIN usersociete ON usersociete.societeID = societe.id 
                INNER JOIN users ON users.id = usersociete.userID 
                WHERE users.id = ?";
    $stmt = $conn->prepare($getmail);
    $stmt->bindParam(1, $userID);
    $stmt->execute();
    try {
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupère tous les résultats
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    // Extraire les emails et appliquer trim()
    $emailArray = array_map(function ($row) {
        return trim($row['email']);  // On récupère l'email de chaque ligne et on enlève les espaces
    }, $emails);

} else {
    // Supposons que $emails provient de l'input de formulaire
    $emails = $_POST['emails'];
    
    // Vérifier si la chaîne se termine par une virgule et la supprimer
    $emails = rtrim($emails, ',');
    
    // Séparer les e-mails par une virgule
    $emailArray = explode(',', $emails);
    
    // Nettoyer les espaces supplémentaires autour des e-mails
    $emailArray = array_map('trim', $emailArray);
    
}


        // Récupération des données envoyées via POST
        $serviceagent = $_POST['serviceagent'] ?? '';
        $userID = $_SESSION['userID'] ?? '';
        $dateevent = $_POST['dateevent'] ?? '';
        $timeevent = $_POST['timeevent'] ?? '';
        $reseau = $_POST['reseaux'] ?? '';
        $ligne = $_POST['ligne'] ?? '';
        $servicevehi = $_POST['services'] ?? '';
        $communevehi = $_POST['communevehi'] ?? '';
        $sensvehi = $_POST['sensvehi'] ?? '';
        $societe = $_POST['societe'] ?? '';
        $immat = $_POST['immatriculation'] ?? '';
        $parc = $_POST['parc'] ?? '';
        $nature = $_POST['nature'] ?? '';
        $conducteur = $_POST['conducteur'] ?? '';
        $details = $_POST['details'] ?? '';
        $operation = $_POST['operation'] ?? '';
        $agent = $_POST['agent'] ?? '';
        $autreparc = $_POST['autreparc'] ?? '';
        $date_now = date('Y/m/d H:i');
        $diffusion = $_POST['choix'] ?? '';
        $emailString = implode(', ', $emailArray); // Convertit le tableau en une chaîne de texte
   


        $formatedtimeevent = date("H:i", strtotime($timeevent));
        $formateddateevent = date("d/m/Y", strtotime($dateevent));
        $formateddate_now = new DateTime("now", new DateTimeZone("Indian/Reunion"));
        $formateddate_now_string = $formateddate_now->format('d/m/Y H:i');  // Formater la date en chaîne
        

        try {
            $submitform = "INSERT INTO `ticket` (`serviceagent`, `userID`, `dateEvent`, `heure`, `reseau`, `ligne`,`servicevehi`, `commune`, `sensvehic`,`societevehic`,`immatriculationvehic`, `parc`, `nature`, `conducteur`, `details`, `traitement`,  `diffusion`,`datecreationticket`,`nomAgent`, `autreparc`,`mail`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $stmt = $conn->prepare($submitform);
    
            // Lier les paramètres
            $date = new DateTime("now", new DateTimeZone("Indian/Reunion"));
            $dateString = $date->format('Y/m/d H:i');

            $stmt->bindParam(1, $serviceagent);
            $stmt->bindParam(2, $userID);
            $stmt->bindParam(3, $dateevent);
            $stmt->bindParam(4, $timeevent);
            $stmt->bindParam(5, $reseau);
            $stmt->bindParam(6, $ligne);
            $stmt->bindParam(7, $servicevehi);
            $stmt->bindParam(8, $communevehi);
            $stmt->bindParam(9, $sensvehi);
            $stmt->bindParam(10, $societe);
            $stmt->bindParam(11, $immat);
            $stmt->bindParam(12, $parc);
            $stmt->bindParam(13, $nature);
            $stmt->bindParam(14, $conducteur);
            $stmt->bindParam(15, $details);
            $stmt->bindParam(16, $operation);
            $stmt->bindParam(17, $diffusion);
            $stmt->bindParam(18, $dateString);
            $stmt->bindParam(19, $agent);
            $stmt->bindParam(20, $autreparc);
            $stmt->bindParam(21, $emailString);
    
            // Exécuter la requête
            $stmt->execute();





            require_once('email.php');
            header("Location: index.php?success=true");
            exit;  // Il est important d'appeler exit() après une redirection pour s'assurer que le script ne 
            


        } catch (PDOException $e) {
            
            echo "Erreur : " . $e->getMessage();
        }

    }
    
    $userID = $_SESSION['userID'];
    $role = $_SESSION['role'];


    //récupère liste des societes
    $getuser = "SELECT * FROM users WHERE users.id = ?";
    $stmt = $conn->prepare($getuser);
    $stmt->BindParam(1,$userID);
    $stmt->execute();
    try {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }

    if ($role == 1 OR $role == 2) {
        $getsociete = "SELECT societe.nom FROM societe";
    } else {
        $getsociete = "SELECT societe.nom FROM societe INNER JOIN usersociete on usersociete.societeID = societe.id INNER JOIN users on users.id = usersociete.userID WHERE users.id = usersociete.userID AND users.id = ?";
    }
    //récupère liste des societes
    $stmt = $conn->prepare($getsociete);
    if ($role ==0 OR $role =='o') {
    $stmt->BindParam(1,$userID);
    }
    $stmt->execute();
    try {
    $societe = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }

    //récupère liste des societes services
    $getsocieteservice = "SELECT societe.nom FROM societe INNER JOIN usersociete on usersociete.societeID = societe.id INNER JOIN users on users.id = usersociete.userID WHERE users.id = usersociete.userID AND users.id = ?"; 
    $stmt = $conn->prepare($getsocieteservice);
    $stmt->BindParam(1,$userID);
    $stmt->execute();
    try {
    $societeservice = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }

    //récupère liste des agents
    $getagent = "SELECT nom FROM agent";
    $stmt = $conn->prepare($getagent);
    $stmt->execute();
    try {
    $agent = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }
    
    

    //récupère liste des communes
    $getcommune = "SELECT commune.nom FROM commune";
    $stmt = $conn->prepare($getcommune);
    $stmt->execute();
    try {
    $commune = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }


    //récupère liste des natures
    $getnature = "SELECT nature.type FROM nature ORDER BY type asc";
    $stmt = $conn->prepare($getnature);
    $stmt->execute();
    try {
    $nature = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }

$role = $_SESSION['role'];
if ($role==1 OR $role==2) {
    $getParc = "SELECT num, immatriculation FROM parc";
    $stmt = $conn->prepare($getParc);
    $stmt->execute();
    try {
    $parcs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
} else {
    $getParc = "SELECT num, immatriculation FROM parc INNER JOIN usersociete on usersociete.societeID = parc.societeID INNER JOIN users on usersociete.userID = users.id WHERE parc.societeID = usersociete.societeID AND usersociete.userID = ? ORDER BY num asc";
    $stmt = $conn->prepare($getParc);
    $stmt->BindParam(1, $userID);
    $stmt->execute();
    try {
    $parcs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
    }
}
// Récupérer les réseaux
$getreseau = "SELECT id, nom FROM reseau";  // Sélectionner à la fois id et nom
$stmt = $conn->prepare($getreseau);
$stmt->execute();
$reseaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialiser un tableau pour stocker les lignes par réseau
$reseautable = [];

foreach ($reseaux as $reseau) {
    $reseau_id = $reseau['id'];  // Utiliser id au lieu de nom
    $reseau_nom = $reseau['nom']; // Vous pouvez encore garder le nom pour l'affichage si nécessaire

    // Récupérer les lignes correspondant à ce réseau (en utilisant id)
    $getligne = "SELECT num FROM ligne WHERE reseau = ?";
    $stmt = $conn->prepare($getligne);
    $stmt->bindParam(1, $reseau_id);  // Utiliser id du réseau
    $stmt->execute();
    $reseautable[$reseau_nom] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Initialiser un tableau pour stocker les services par ligne
$services = [];

foreach ($reseautable as $reseau_nom => $lignes) {
    foreach ($lignes as $ligne) {
        $ligne_num = $ligne['num'];
        
        // Récupérer les services pour cette ligne
        $services_sql = "SELECT num FROM service WHERE ligne = ?";
        $stmt = $conn->prepare($services_sql);
        $stmt->bindParam(1, $ligne_num);  // Utiliser num de la ligne
        $stmt->execute();
        
        // Ajouter les services trouvés dans le tableau
        $services[$ligne_num] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!-- On passe les données PHP dans le JavaScript -->
<script>
    // Passer les données PHP en JavaScript via json_encode
    const reseautable = <?php echo json_encode($reseautable); ?>;
    const services = <?php echo json_encode($services); ?>;
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="creer-un-ticket.css">
    <link rel="stylesheet" href="style.css">
    <title>Créer un ticket</title>
    <style>
        /* Style pour le div qui simule le blur */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Fond sombre */
            backdrop-filter: blur(5px); /* Flou de l'arrière-plan */
            display: none; /* Masqué par défaut */
            z-index: 9999; /* Au-dessus de tous les autres éléments */
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
        }
    </style>
</head>

    <body>

    <?php 
    
        

    ?>

    <script>
    // Fonction pour mettre à jour les options du select "ligne"
    function updateLigne() {
        const reseau = document.getElementById('reseaux').value; // Récupère le réseau sélectionné
        const ligneSelect = document.getElementById('ligne'); // Récupère le select pour les lignes
        const servicesSelect = document.getElementById('services'); // Récupère le select pour les services

        // Effacer les options précédentes
        ligneSelect.innerHTML = '<option value="">Sélectionner une ligne</option>';
        servicesSelect.innerHTML = '<option value="">Sélectionner un service</option>';

        // Vérifier si des lignes sont disponibles pour ce réseau
        if (reseautable[reseau]) {
            reseautable[reseau].forEach(function(ligne) {
                const option = document.createElement('option');
                option.value = ligne.num;
                option.textContent = ligne.num;
                ligneSelect.appendChild(option);
            });
        }
    }

    // Fonction pour mettre à jour les options du select "services"
    function updateServices() {
        const ligne = document.getElementById('ligne').value; // Récupère la ligne sélectionnée
        const servicesSelect = document.getElementById('services'); // Récupère le select pour les services

        // Effacer les options précédentes
        servicesSelect.innerHTML = '<option value="">Sélectionner un service</option>';

        // Vérifier si des services sont disponibles pour cette ligne
        if (services[ligne]) {
            services[ligne].forEach(function(service) {
                const option = document.createElement('option');
                option.value = service.num;
                option.textContent = service.num;
                servicesSelect.appendChild(option);
            });
        }
    }
</script>

<script>
// Fonction pour mettre à jour la valeur de l'immatriculation en fonction du parc sélectionné
function updateImmat() {
    const parc = document.getElementById('parc').value; // Récupère le parc sélectionné
    const immatriculationInput = document.getElementById('immatriculation'); // Récupère l'input d'immatriculation

    // Si aucun parc n'est sélectionné, réinitialise l'immatriculation
    if (!parc) {
        immatriculationInput.value = ''; // Réinitialise la valeur de l'immatriculation
        return;
    }

    // Récupère les données des parcs
    const parcs = <?php echo json_encode($parcs); ?>;

    // Cherche l'immatriculation correspondant au parc sélectionné
    const parcObj = parcs.find(parcObj => parcObj.num == parc);

    // Si un parc est trouvé, attribue l'immatriculation à l'input
    if (parcObj) {
        immatriculationInput.value = parcObj.immatriculation;
    }
}

// Fonction pour mettre à jour la valeur du parc en fonction de l'immatriculation sélectionnée
function updateParc() {
    const immatriculation = document.getElementById('immatriculation').value; // Récupère l'immatriculation sélectionnée
    const parcInput = document.getElementById('parc'); // Récupère l'input du parc

    // Si aucune immatriculation n'est sélectionnée, réinitialise le parc
    if (!immatriculation) {
        parcInput.value = ''; // Réinitialise la valeur du parc
        return;
    }

    // Récupère les données des parcs
    const parcs = <?php echo json_encode($parcs); ?>;

    // Cherche le parc correspondant à l'immatriculation sélectionnée
    const parcObj = parcs.find(parcObj => parcObj.immatriculation === immatriculation);

    // Si un parc est trouvé, attribue le numéro du parc à l'input
    if (parcObj) {
        parcInput.value = parcObj.num;
    }
}


</script>



        <form id="monFormulaire" action="creer-un-ticket.php" method="POST"> 
            <div class="form-container">

                Informations agent
                <div class='box'>

                                <!-- societe de l'agent -->
                                            <label for="serviceagent">Exploitation:*</label>
                                            <select name="serviceagent" id="serviceagent" required>
                                                    <option value=""></option>
                                                    <?php
                                                        foreach ($societeservice as $row) {
                                                            echo '<option value="'.htmlspecialchars($row['nom']).'">'.htmlspecialchars($row['nom']).'</option>';
                                                        }
                                                    ?>
                                            </select>

                                                <br>
                                                
                            <!-- nom de l'agent -->
                            <label for="nomagent">Nom de l'agent:</label>
                            <select name="agent" id="agent">
                            
                            <!--crée une liste avec data récupérés -->
                                    <option value=""></option>
                                    <?php
                                        foreach ($agent as $row) {
                                            echo '<option value="'.htmlspecialchars($row['nom']).'">'.htmlspecialchars($row['nom']).'</option>';
                                        }
                                    ?>
                            </select>

                        <p>créé à 
                            
                                    <?php 
                        
                                    $date = new DateTime("now", new DateTimeZone("Indian/Reunion"));
                                    echo $date->format('H\hi');
                                    
                                    ?>
                                    
                        </p>

                </div>

                <br>

                    Informations événement

                    <!-- date et heure -->
                    <div class='box'>

                                            <label for="dateevent" >Date:*</label>
                                            <input type="date" name="dateevent" id="dateevent" required>
                                            
                                            <br>

                                            <label for="timeevent">Heure:*</label>
                                            <input type="time" name="timeevent" id="timeevent" required>

                    </div>

                    <br>

                    Informations véhicule
                    <div class='box'>
                            <!-- entrée pour societe vehicule-->
                                    <label for="reseaux">Réseau:</label>
                                    <select name="reseaux" id="reseaux" onchange="updateLigne()">
                                        <option value=""></option>
                                        <?php
                                            foreach ($reseaux as $row) {
                                                echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                                            }
                                        ?>
                                    </select>

                            <br>


                            <label for="ligne">Ligne:</label>
                            <select id="ligne" name="ligne" onchange="updateServices()">
                            </select>

                            <br>

                            <label for="services">Service:</label>
                            <select id="services" name="services">
                            </select>

 

                            <br><br>

                            <!-- entrée pour commune --> 
                                    <label for="service">Commune:</label>
                                    <select name="communevehi" id="communevehi">
                                        <option value=""></option>
                            <!--crée une liste avec data récupérés -->
                                        <?php
                                            foreach ($commune as $row) {
                                                echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                                            }
                                        ?>
                                    </select>

                            <br>

                            <!-- entrée pour sens vehicule -->
                                    <label for="sensvehi">Sens du véhicule:</label>
                                    <select name="sensvehi" id="sensvehi">

                                        <option value=""></option>
                                        <option value="aller">Aller</option>
                                        <option value="Retour">Retour</option>

                                    </select>

                            <br>

                            <!-- entrée pour societe --> 
                                    <label for="societe">Transporteur:</label>
                                    <select name="societe" id="societe" >
                            <!--crée une liste avec data récupérés -->
                                            <option value=""></option>
                                        <?php
                                            foreach ($societe as $row) {
                                                echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                                            }
                                        ?>
                                    </select>

                                    <br><br>

                                                                                <label for="parc">N° de parc:</label>
                                            <select name="parc" id="parc" onchange="updateImmat()">
                                                <option value="">Sélectionner un numéro de parc</option>
                                                <?php
                                                    foreach ($parcs as $row) {
                                                        echo '<option value="' . htmlspecialchars($row['num']) . '">' . htmlspecialchars($row['num']) . '</option>';
                                                    }
                                                ?>
                                            </select>

                                            <br>

                                            <!-- Entrée pour immatriculation -->
                                            <label for="immatriculation">Immatriculation:</label>
                                            <select name="immatriculation" id="immatriculation" onchange="updateParc()">
                                                <option value="">Sélectionner une immatriculation</option>
                                                <?php
                                                    foreach ($parcs as $row) {
                                                        echo '<option value="' . htmlspecialchars($row['immatriculation']) . '">' . htmlspecialchars($row['immatriculation']) . '</option>';
                                                    }
                                                ?>
                                            </select>



 

                                    <br>
                            
                            <!-- entrée pour autre num or immat -->
                                <label for="autreparc">Autre:</label>
                                <input type="text" name='autreparc' id="autreparc">

                        </div>

                        <br>

                        Evènement

                        <div class="box">

                            <!-- entrée pour nature --> 
                                    <label for="nature">Nature:*</label>
                                    <select name="nature" id="nature" required>

                                        <option value=""></option>
                            <!--crée une liste avec data récupérés -->
                                        <?php
                                            foreach ($nature as $row) {
                                                echo '<option value="' . htmlspecialchars($row['type']) . '">' . htmlspecialchars($row['type']) . '</option>';
                                            }
                                        ?>

                                    </select>
                        <br>

                            <!-- entrée pour conducteur -->
                                    <label for="conducteur">Conducteur :</label>
                                    <input type="text" name='conducteur' id="conducteur">
                                    
                        <br>

                            <!-- entrée pour details -->
                                    <label for="details">Détails:</label>
                                    <textarea type="textInput" name='details' id="details" placeholder="Décrivez la situation..." maxlength="300"></textarea>
                                    <p style="margin:0;font-size: 17px" id="charCount">Caractères restants : 300</p>
                        </div>
                            <script>
                                    const details = document.getElementById('details');
                            const charCount = document.getElementById('charCount');

                            details.addEventListener('input', function() {
                                const remainingChars = 300 - details.value.length;
                                charCount.textContent = `Caractères restants : ${remainingChars}`;
                            });
                            </script>
                        <br>

                        Traitement

                        <div class="box">

                            <!-- entrée pour operation -->
                            <label for="operation">Opération réalisée:</label>
                            <textarea type="text" name="operation" id="operation" placeholder="Quelles sont les actions réalisées ?" maxlength="300"></textarea>
                            <p id="charCountoperation" style="margin:0;font-size: 17px">Caractères restants : 300</p>
                        </div>
                            <script>
                                        const operation = document.getElementById('operation');
                                const charCountoperation = document.getElementById('charCountoperation');

                                operation.addEventListener('input', function() {
                                    const remainingCharsope = 300 - operation.value.length;
                                    charCountoperation.textContent = `Caractères restants : ${remainingCharsope}`;
                                });
                            </script>
                        <br>

                        Diffusion

                        <div class="boxdiffusion">

                        <!-- entrée pour diffusion --> 
                        <label for="emails">Diffuser le document ?*</label>

                        <br>
                    <div class="radio">
                        <div class="oui">
                    <label for="oui">
                        <input type="radio" id="oui" name="choix" value="oui" required checked>
                            Oui ( e-mail programmé )
                        </label>
                        </div>
                        
                        <div class="non">
                        <label for="non">
                        <input type="radio" id="non" name="choix" value="non" required>
                            Non ( entrez les adresses e-mail séparées par des virgules ) :
                        </label>
                        <script>
        // Fonction JavaScript pour formater les emails
        function formatEmails() {
            var emailInput = document.getElementById('emails');
            var emailValue = emailInput.value;

            // Remplacer les espaces par des virgules
            emailValue = emailValue.replace(/\s+/g, ','); // Remplace tous les espaces par une virgule

            // Conserver la virgule si elle existe déjà et n'ajouter qu'une seule virgule
            emailValue = emailValue.replace(/,+/g, ','); // Enlever les virgules multiples consécutives

            // Mettre à jour la valeur de l'input
            emailInput.value = emailValue;
        }

  
    </script>
                        <input type="text" id="emails" name="emails" placeholder="email1@example.com, email2@example.com"  oninput="formatEmails()"><br><br>
                    </div>

                </div>
                </div>
            <br>

        </form>

        <div class="button-container">

            <a class="cancel" href="index.php">Abandonner</a>
            <button id="submit" type="submit">Envoyer</button>

        </div>
 <!-- Div pour simuler le blur -->
 <div id="overlay">
        Envoie en cours... <br>Veuillez patienter.
    </div>
    <a href="mentionslegales.php" style="text-decoration: underline; font-size:14px; text-decoration:none; color: black; position:fixed; bottom:10px;left:10px">Mentions légales</a>
    <script>
        document.getElementById('monFormulaire').addEventListener('submit', function(event) {

            // Affiche le div avec l'effet de blur
            document.getElementById('overlay').style.display = 'flex';
        });
    </script>
    </body>

</html>
