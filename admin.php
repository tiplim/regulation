<?php 
session_start(); // Démarre la session pour vérifier si l'utilisateur est connecté
require_once('cnx.php'); // Connexion à la base de données
require("header-function.php");
$redirectUrl2 = 'index.php'; // Redirection par défaut


$redirectUrl = 'login.php';
if(!isset($_SESSION['userID'])){
    header("Location: $redirectUrl"); // Redirection si l'utilisateur n'est pas connecté
    exit();
}

// Vérifie si l'utilisateur est un administrateur, sinon le redirige
if($_SESSION['role'] != 2){
    header("Location: $redirectUrl2"); // Redirection si l'utilisateur n'est pas admin
    exit();
}

// Inclusion de la fonction d'entête

require_once('get-function-admin.php');
require_once('function-admin.php');

$getvehicule = "SELECT * FROM parc INNER JOIN societe on societe.id = parc.societeID";
$stmt = $conn->prepare($getvehicule);
$stmt->execute();
try {
    $vehitable = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css" >
    <link rel="stylesheet" href="style.css" >
    <title>Administrateur</title>
</head>
<body>
<div class="messagebox"><?php 

    if(isset($existinguser)) {
        echo $existinguser;
    };

?></div>
<div class="div-container">
    <!-- Formulaire d'ajout d'un utilisateur -->
    <div class="block">
        <h2>Ajouter un Utilisateur</h2>
        <form method="POST" action="admin.php">
            <label for="id">Nom d'utilisateur (nom.prenom) :</label>
            <input type="text" name="id" id="id" required>
            <br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <br><br>

            <label for="societe">Société:</label>
            <select name="societe" id="societe" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des sociétés
                    foreach ($societe as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="o">Standard</option>
                <option value="1">Supérieur</option>
                <option value="2">Administrateur</option>
            </select>
             <p style="margin: 2px ;font-size:13px; color:rgb(163, 89, 89)">(Attention, Administrateur a accès à cette page)</p>
            <br><br>

            <button type="submit" name="adduser" class="bluebutton">Ajouter l'utilisateur</button>
        </form>
        <div class="listeacces">
                    <table>
                        <tr>
                            <th>utilisateur</th>
                            <th>société</th>
                            <th>rôle</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            foreach ($users as $row) {
                                $role = htmlspecialchars($row["role"]);
                                if ($role ==2) {
                                    $role = "admin";
                                } elseif ($role == 1) {
                                    $role = "supérieur";
                                } else {
                                    $role = "standard";
                                }
                                echo "<tr style='text-align:center;'>
                                        <td>" . htmlspecialchars($row["id"]) . "</td>
                                        <td>" . htmlspecialchars($row["nom"]) . "</td>
                                        <td>" . $role . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>


            </div>
        <div>
        <h2>Modifier un Utilisateur</h2>
        <form method="POST" action="admin.php">
        <label for="usertoedit">Utilisateur à modifier :</label>
        <select name="usertoedit" id="usertoedit" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($users as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</option>';
                    }
                ?>
            </select><br><br>
            <label for="editpass">Nouveau mot de passe :</label>
            <input type="password" name="editpass" id="editpass"><br><br>
            <label for="editsoc">Nouvelle société :</label>
            <select name="editsoc" id="editsoc"><br>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($societes as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select><br><br>
            <label for="editrole">Nouveau Rôle :</label>
            <select name="editrole" id="editrole">
                <option value=""></option>
                <option value="o">Standard</option>
                <option value="1">Supérieur</option>
                <option value="2">Administrateur</option>
            </select> <p style="margin: 2px ;font-size:13px; color:rgb(163, 89, 89)">(Attention, Administrateur a accès à cette page)</p>
            <br><br>

            <button type="submit" name="edituser" class="editbutton">modifier l'utilisateur</button>
        </form></div>
        <h2>Supprimer un Utilisateur</h2>
        <form method="POST" action="admin.php">
            <label for="user">Nom d'utilisateur :</label>
            <select name="user" id="user" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($users as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removeuser" class="redbutton">Supprimer l'utilisateur</button>
        </form>
    </div>
    
    <!-- Formulaire de suppression d'utilisateur -->
    <div class="block">


        <h2>Accès Utilisateur à Société </h2>
        <form method="POST" action="admin.php">
            <label for="userforsoc">Nom d'utilisateur :</label>
            <select name="userforsoc" id="userforsoc" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($users as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</option>';
                    }
                ?>
            </select>
            <br><br>
            <label for="addsoctouser">Société :</label>
            <select name="addsoctouser" id="addsoctouser" required><br>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($societes as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="addusersoc" class="bluebutton">Ajouter la société</button>
            <button type="submit" name="suppusersoc" class="redbutton">Supprimer la société</button>
        </form>

        <div class="listeacces">
                    <table>
                        <tr>
                            <th>utilisateur</th>
                            <th></th>
                            <th>société</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            foreach ($societesusers as $row) {
                                echo "<tr style='text-align:center;'>
                                        <td>" . htmlspecialchars($row["userID"]) . "</td>
                                        <td> > </td>
                                        <td>" . htmlspecialchars($row["nom"]) . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>


            </div>

    </div>

    <!-- Formulaire d'ajout d'agent -->
    <div class="block">
        <h2>Ajouter un Agent</h2>
        <form method="POST" action="admin.php">
            <label for="agent">Nom de l'Agent :</label>
            <input type="text" name="agent" id="agent" required>
            <br><br>

            <button type="submit" name="addagent" class="bluebutton">Ajouter l'Agent</button>
        </form>
        <div class="listeacces">
                    <table>
                        <tr>
                            <th>Agent</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            foreach ($agents as $row) {
                                echo "<tr style='text-align:center;'>
                                        <td>" . htmlspecialchars($row["nom"]) . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>


            </div>
    </div>
    

    <!-- Formulaire de suppression d'agent -->
    <div class="block">
        <h2>Supprimer un Agent</h2>
        <form method="POST" action="admin.php">
            <label for="suppagent">Agent :</label>
            <select name="suppagent" id="suppagent" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($agents as $row) {
                        echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removeagent" class="redbutton">Supprimer l'agent</button>
        </form>
    </div>
    <div class="block">
        <h2>Ajouter une Ligne</h2>
        <form method="POST" action="admin.php">

            <label for="reseauadd">Réseau :</label>
            <select name="reseauadd" id="reseauadd" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($reseaux as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select><br><br>
            <label for="ligne">Numéro de ligne :</label>
            <input type="text" name="ligne" id="ligne" required>

            <br><br>

            <button type="submit" name="addligne" class="bluebutton">Ajouter la ligne</button>
        </form>
        <div class="listeacces">
                    <table>
                        <tr>
                            <th>Réseau</th>
                            <th>Ligne</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            foreach ($ligne as $row) {
                                echo "<tr style='text-align:center;'>
                                        <td>" . htmlspecialchars($row["nom"]) . "</td>
                                        <td>" . htmlspecialchars($row["num"]) . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>


            </div>
    </div>
      <!-- Formulaire de suppression d'une ligne -->
      <div class="block">
        <h2>Supprimer une Ligne</h2>
        <form method="POST" action="admin.php">
            <label for="ligne">Numéro de ligne :</label>
            <select name="ligne" id="ligne" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($ligne as $row) {
                        echo '<option value="' . htmlspecialchars($row['num']) . '">' .htmlspecialchars($row['nom']) . ", " . htmlspecialchars($row['num']) . '</option>';
                    }
                ?>
            </select><p style="margin: 2px ;font-size:13px; color:rgb(163, 89, 89)">(Attention, les services seront également supprimés)</p>
            <br><br>

            <button type="submit" name="removeligne" class="redbutton">Supprimer la ligne</button>
        </form>
    </div>
    <div class="block">
    <h2>Ajouter un Service</h2>

<!-- Formulaire avec onChange pour filtrer les services -->
<form method="POST" action="admin.php">
    <label for="ligneassoc">Numéro de ligne:</label>
    <select name="ligneassoc" id="ligneassoc" required>
        <option value="">Sélectionner une ligne</option>
        <?php
            // Remplissage de la liste des lignes dans la liste déroulante
            foreach ($lignes as $row) {
                echo '<option value="' . htmlspecialchars($row['num']) . '">' . htmlspecialchars($row['num']) . '</option>';
            }
        ?>
    </select><br><br>
            <label for="service">Numéro de service associé:</label>
            <input type="text" name="service" id="service" required>

            <br><br>
            <button type="submit" name="addservice" class="bluebutton">Ajouter le service</button>
</form>

<div class="listeacces">
    <table id="servicesTable">
        <thead>
            <tr>
                <th>Ligne</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Affichage de tous les services dans le tableau
                foreach ($services as $row) {
                    echo "<tr class='serviceRow' data-ligne='" . htmlspecialchars($row['ligne']) . "'>                   
                            <td>" . htmlspecialchars($row["ligne"]) . "</td>
                            <td>" . htmlspecialchars($row["num"]) . "</td>
                          </tr>";
                }
            ?>
        </tbody>
    </table>

<script>
// Filtrer les services en fonction de la ligne sélectionnée
document.getElementById("ligneassoc").addEventListener("change", function() {
    const selectedLigne = this.value;
    const rows = document.querySelectorAll("#servicesTable .serviceRow");

    rows.forEach(row => {
        const rowLigne = row.getAttribute('data-ligne');

        if (selectedLigne === "" || rowLigne === selectedLigne) {
            // Afficher la ligne si elle correspond ou si aucune ligne n'est sélectionnée
            row.style.display = "";
        } else {
            // Masquer la ligne si elle ne correspond pas à la ligne sélectionnée
            row.style.display = "none";
        }
    });
});
</script>


</div>

<div>
    <h2>Modifier un Service</h2>
    <form method="POST" action="admin.php">
    <label for="idserv">Service à modifier :</label>
            <select name="idserv" id="idserv" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($numserv as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['num']) . '</option>';
                    }
                ?>
            </select><br><br>
        
        <label for="newservnum">Nouveau numéro :</label>
        <input type="text" name="newservnum" id="newservnum"><br><br>
        
        <label for="newligneserv">Nouvelle Ligne associée :</label>
            <select name="newligneserv" id="newligneserv">
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($ligne as $row) {
                        echo '<option value="' . htmlspecialchars($row['num']) . '">' . htmlspecialchars($row['num']) . '</option>';
                    }
                ?>
            </select><br><br>

        <button type="submit" name="editservice" class="editbutton">Modifier le service</button>
    </form>
</div>
</div>
      <!-- Formulaire de suppression d'une ligne -->
      <div class="block">
        <h2>Supprimer un Service</h2>
        <form method="POST" action="admin.php">
            <label for="numserv">Numéro de service :</label>
            <select name="numserv" id="numserv" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des utilisateurs
                    foreach ($services as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">Ligne ' . htmlspecialchars($row['ligne']). ", Service " . htmlspecialchars($row['num']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removeservice" class="redbutton">Supprimer le service</button>
        </form>
    </div>
    <!-- Formulaire d'ajout d'une commune -->
    <div class="block">
        <h2>Ajouter une Commune</h2>
        <form method="POST" action="admin.php">
            <label for="commune">Nom de la commune :</label>
            <input type="text" name="commune" id="commune" required>
            <br><br>

            <button type="submit" name="addcommune" class="bluebutton">Ajouter la commune</button>
        </form>
        <div class="listeacces">
            <table>
                <tr>
                    <th>commune</th>
                </tr>
                <tbody>
                    <?php 
                            
                            foreach ($communes as $row) {
                                echo "<tr style='text-align:center;'>
                                <td>" . htmlspecialchars($row["nom"]) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>
    <!-- Formulaire de suppression d'une commune -->
    <div class="block">
        <h2>Supprimer une Commune</h2>
        <form method="POST" action="admin.php">
            <label for="suppcommune">Commune :</label>
            <select name="suppcommune" id="suppcommune" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des communes
                    foreach ($communes as $row) {
                        echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removecommune" class="redbutton">Supprimer la commune</button>
        </form>
    </div>
        <!-- Formulaire d'ajout de nature -->
        <div class="block">
        <h2>Ajouter une Nature</h2>
        <form method="POST" action="admin.php">
            <label for="agent">Nature :</label>
            <input type="text" name="nature" id="nature" required>
            <br><br>

            <button type="submit" name="addnature" class="bluebutton">Ajouter la nature</button>
        </form>
        <div class="listeacces">
            <table>
                <tr>
                    <th>type</th>
                </tr>
                <tbody>
                    <?php 
                            
                            foreach ($natures as $row) {
                                echo "<tr style='text-align:center;'>
                                <td>" . htmlspecialchars($row["type"]) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>
    </div>

    <!-- Formulaire de suppression de nature -->
    <div class="block">
        <h2>Supprimer une Nature</h2>
        <form method="POST" action="admin.php">
            <label for="suppnature">Nature :</label>
            <select name="suppnature" id="suppnature" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($natures as $row) {
                        echo '<option value="' . htmlspecialchars($row['type']) . '">' . htmlspecialchars($row['type']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removenature" class="redbutton">Supprimer la nature</button>
        </form>
    </div>
        <!-- Formulaire d'ajout de reseau -->
        <div class="block">
        <h2>Ajouter un Réseau</h2>
        <form method="POST" action="admin.php">
            <label for="reseau">Réseau :</label>
            <input type="text" name="reseau" id="reseau" required>
            <br><br>

            <button type="submit" name="addreseau" class="bluebutton">Ajouter le réseau</button>
        </form>
        <div class="listeacces">
            <table>
                <tr>
                    <th>Réseau</th>
                </tr>
                <tbody>
                    <?php 
                            
                            foreach ($reseaux as $row) {
                                echo "<tr style='text-align:center;'>
                                <td>" . htmlspecialchars($row["nom"]) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>
    </div>

    <!-- Formulaire de suppression de reseau -->
    <div class="block">
        <h2>Supprimer un Réseau</h2>
        <form method="POST" action="admin.php">
            <label for="suppreseau">Réseau :</label>
            <select name="suppreseau" id="suppreseau" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($reseaux as $row) {
                        echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removereseau" class="redbutton">Supprimer le réseau</button>
        </form>
    </div>
        <!-- Formulaire d'ajout de societe -->
        <div class="block">
        <h2>Ajouter une Société</h2>
        <form method="POST" action="admin.php">
            <label for="societe">Nom de la société :</label>
            <input type="text" name="societe" id="societe" required>
            <br><br>

            <button type="submit" name="addsociete" class="bluebutton">Ajouter la société</button>
        </form>
        <div class="listeacces">
            <table>
                <tr>
                    <th>Société</th>
                </tr>
                <tbody>
                    <?php 
                            
                            foreach ($societes as $row) {
                                echo "<tr style='text-align:center;'>
                                <td>" . htmlspecialchars($row["nom"]) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>

    <!-- Formulaire de suppression de societe -->
        <h2>Supprimer une société</h2>
        <form method="POST" action="admin.php">
            <label for="suppsociete">Société :</label>
            <select name="suppsociete" id="suppsociete" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($societes as $row) {
                        echo '<option value="' . htmlspecialchars($row['nom']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removesociete" class="redbutton">Supprimer la société</button>
        </form>
    </div>




<!-- Formulaire d'ajout de mail -->
<div class="block">
        <h2>Ajouter un Email de Diffusion</h2>
        <form method="POST" action="admin.php">
        <label for="societemail">Société :</label>
        <select name="societemail" id="societemail" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($societes as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select><br><br>
            <label for="addemail">Email :</label>
            <input type="text" name="addemail" id="addemail" placeholder="email@exemple.com" required><br><br>
            <br><br>

            <button type="submit" name="addmailsociete" class="bluebutton">Ajouter l'email</button>
        </form>
        <div class="listeacces">
            <table>
                <tr>
                    <th>Société</th>
                    <th></th>
                    <th>Email de diffusion</th>
                </tr>
                <tbody>
                    <?php 
                            
                            foreach ($emails as $row) {
                                echo "<tr style='text-align:center;'>
                                <td>" . htmlspecialchars($row["nom"]) . "</td>
                                <td></td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                </div>



    <!-- Formulaire de suppression de mail -->
        <h2>Supprimer un Email de Diffusion</h2>
        <form method="POST" action="admin.php">
            <label for="suppmailsoc">Société :</label>
            <select name="suppemailsoc" id="suppemailsoc" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des societes
                    foreach ($societetosupp as $row) {
                        echo '<option value="' . htmlspecialchars($row['societeID']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <select name="suppemail" id="suppemail" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($emailtosupp as $row) {
                        echo '<option value="' . htmlspecialchars($row['email']) . '">' . htmlspecialchars($row['email']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removeemail" class="redbutton">Supprimer l'email</button>
        </form>
    </div>







        <!-- Formulaire d'ajout de parc -->
        <div class="block">
        <h2>Ajouter un Vehicule</h2>
        <form method="POST" action="admin.php">
            <label for="immatriculation">Immatriculation :</label>
            <input type="text" name="immatriculation" id="immatriculation" oninput="formatImmatadd()" maxlength="9" required><br><br>
            <label for="numparc">Numéro de parc :</label>
            <input type="text" name="numparc" id="numparc"><br><br>
            <label for="societevehic">Société :</label>
            <select name="societevehic" id="societevehic" required><br>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($societes as $row) {
                        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="addvehicule" class="bluebutton">Ajouter le véhicule</button>
        </form>
        <div class="listevehi">
                    <table>
                        <tr>
                            <th>Immatriculation</th>
                            <th>Numéro de parc</th>
                            <th>Société</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            foreach ($vehitable as $row) {
                                echo "<tr style='text-align:center;'>
                                        <td>" . htmlspecialchars($row["immatriculation"]) . "</td>
                                        <td>" . htmlspecialchars($row["num"]) . "</td>
                                        <td>" . htmlspecialchars($row["nom"]) . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>


            </div>
            <script>
// Fonction pour formater l'immatriculation en "AA 000 00"
function formatImmatadd() {
    var input = document.getElementById('immatriculation');
    var value = input.value.replace(/[^A-Za-z0-9]/g, ''); // Enlève les caractères non alphanumériques
    value = value.toUpperCase(); // Mettre en majuscules

    // Applique le format "AA 000 00"
    if (value.length >= 6) {
        value = value.slice(0, 2) + ' ' + value.slice(2, 5) + ' ' + value.slice(5, 7);
    } else if (value.length >= 3) {
        value = value.slice(0, 2) + ' ' + value.slice(2, 5);
    }

    input.value = value;
}
</script>
            <div>
    <h2>Modifier un Véhicule</h2>
    <form method="POST" action="admin.php">
        <label for="vehitoedit">Véhicule à modifier :</label>
        <select name="vehitoedit" id="vehitoedit" required>
            <option value=""></option>
            <?php
                // Remplissage de la liste des véhicules
                foreach ($immatriculations as $row) {
                    echo '<option value="' . htmlspecialchars($row['immatriculation']) . '">' . htmlspecialchars($row['immatriculation']) . '</option>';
                }
            ?>
        </select><br><br>
        
        <label for="editimmat">Nouvelle immatriculation :</label>
        <input type="text" name="editimmat" id="editimmat" oninput="formatImmat()" maxlength="9" required><br><br>
        
        <label for="editnum">Nouveau numéro de parc :</label>
        <input type="text" name="editnum" id="editnum"><br><br>
        
        <label for="editsoc">Nouvelle société :</label>
        <select name="editsoc" id="editsoc">
            <option value=""></option>
            <?php
                // Remplissage de la liste des sociétés
                foreach ($societes as $row) {
                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</option>';
                }
            ?>
        </select>
        <br><br>

        <button type="submit" name="editvehicule" class="editbutton">Modifier le véhicule</button>
    </form>
</div>

<script>
// Fonction pour formater l'immatriculation en "AA 000 00"
function formatImmat() {
    var input = document.getElementById('editimmat');
    var value = input.value.replace(/[^A-Za-z0-9]/g, ''); // Enlève les caractères non alphanumériques
    value = value.toUpperCase(); // Mettre en majuscules

    // Applique le format "AA 000 00"
    if (value.length >= 6) {
        value = value.slice(0, 2) + ' ' + value.slice(2, 5) + ' ' + value.slice(5, 7);
    } else if (value.length >= 3) {
        value = value.slice(0, 2) + ' ' + value.slice(2, 5);
    }

    input.value = value;
}
</script>

        
        

    </div>

    <!-- Formulaire de suppression de parc -->
    <div class="block">
        <h2>Supprimer un Véhicule</h2>
        <form method="POST" action="admin.php">
            <label for="suppimmat">Immatriculation :</label>
            <select name="suppimmat" id="suppimmat" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($immatriculations as $row) {
                        echo '<option value="' . htmlspecialchars($row['immatriculation']) . '">' . htmlspecialchars($row['immatriculation']) . '</option>';
                    }
                ?>
            </select>
            <br><br>

            <button type="submit" name="removevehicule" class="redbutton">Supprimer le véhicule</button>
        </form>
    </div>

</div>
<div class="block">
        <h2>ANONYMISATION Conducteur</h2>
        <form method="POST" action="admin.php">
            <label for="nomconducteur">nom du conducteur :</label>
            <select name="nomconducteur" id="nomconducteur" required>
                <option value=""></option>
                <?php
                    // Remplissage de la liste des agents
                    foreach ($conducteur as $row) {
                        echo '<option value="' . htmlspecialchars($row['conducteur']) . '">' . htmlspecialchars($row['conducteur']) . '</option>';
                    }
                ?>
            </select>
            <p style="margin: 2px ;font-size:13px; color:rgb(163, 89, 89)"><br>( L'anonymisation du conducteur consiste à supprimer son nom ainsi que <br> les informations permettant de l'identifier. )</p>
            <br>

            <button type="submit" name="anonymisation" class="redbutton">Anonymiser le conducteur</button>
        </form>
    </div>
<div class="block" style='background:#ffd7d7'>
        <h2>SUPPRESSION Incidents</h2>
        <form method="POST" action="admin.php">
            <label for="interval">Supprimer les incidents datants de plus de </label>
            <select name="interval" id="interval" required>
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
               
            </select> année(s).
            <p style="margin: 2px ;font-size:13px; color:rgb(202, 85, 85)"><br>( Tous les incidents dont la date de création est inférieure à l'année séléctionnée seront supprimés. )</p>
            <br>

            <button type="submit" name="supptickets" class="redbutton">Supprimer les incidents</button>
        </form>
    </div>
    <a href="mentionslegales.php" style="text-decoration: underline; font-size:14px; text-decoration:none; color: black; position:fixed; bottom:10px;right:10px">Mentions légales</a>
</body>
</html>

