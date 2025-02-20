<?php

// Gestion de l'ajout d'un utilisateur
if (isset($_POST['adduser'])) {
    // Validation des données
    $id = htmlspecialchars($_POST["id"]);
    $password = $_POST['password'];
    $societe = htmlspecialchars($_POST['societe']);
    $role = $_POST['role'];

    // Vérification de la validité de l'ID
    if (!preg_match('/^[a-zA-Z\.]+$/', $id)) {
        $existinguser = "L'ID utilisateur est invalide.";
    } else {
        // Hachage du mot de passe pour sécuriser le stockage
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Vérifie si l'utilisateur existe déjà dans la base de données
        $checksql = "SELECT id FROM users WHERE id = ?";
        $stmt = $conn->prepare($checksql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        // Si l'utilisateur existe déjà, afficher un message
        if ($stmt->rowCount() > 0) {
            $existinguser = "L'utilisateur existe déjà";
        } else {
            // Insertion d'un nouvel utilisateur dans la base de données
            try {
                $sql = "INSERT INTO users (id, password, societe, role) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $id);
                $stmt->bindParam(2, $hashedPassword);
                $stmt->bindParam(3, $societe);
                $stmt->bindParam(4, $role, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                error_log("Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage());
                $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
            }
            try {
                $sql = "INSERT INTO usersociete (userID, societeID) VALUES (?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $id);
                $stmt->bindParam(2, $societe);
                $stmt->execute();
                header("Location: admin.php"); // Redirection vers la page admin
                exit();
            } catch (PDOException $e) {
                error_log("Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage());
                $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
            }
        }
    }
}

// Gestion de la suppression d'un utilisateur
if (isset($_POST['removeuser'])) {
    $userpost = htmlspecialchars($_POST["user"]); // Récupère l'utilisateur à supprimer et échappe les caractères spéciaux
    
    try {
        // Prépare la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $userpost);
        $stmt->execute();
    
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        $existinguser = "Une erreur est survenue";
    }
    try {
        // Prépare la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM usersociete WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $userpost);
        $stmt->execute();
    
        header("Location: admin.php"); // Redirection vers la page admin
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        $existinguser = "Une erreur est survenue";
    }
}

// Gestion de la suppression d'un utilisateur
if (isset($_POST['addusersoc'])) {
    $usertosoc = htmlspecialchars($_POST["userforsoc"]); // Récupère l'utilisateur à supprimer et échappe les caractères spéciaux
    $addsoctouser = htmlspecialchars($_POST["addsoctouser"]); // Récupère l'utilisateur à supprimer et échappe les caractères spéciaux

    try {
        // Prépare la requête pour supprimer l'utilisateur
        $sql = "INSERT INTO usersociete(userID , societeID) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $usertosoc);
        $stmt->bindParam(2, $addsoctouser);
        $stmt->execute();

        header("Location: admin.php"); // Redirection vers la page admin
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de la société à l'utilisateur': " . $e->getMessage());
        $existinguser = "L'utilisateur a déjà accès à cette société";
    }
}

// Gestion de la suppression d'un utilisateur
if (isset($_POST['suppusersoc'])) {
    $usertosoc = htmlspecialchars($_POST["userforsoc"]); // Récupère l'utilisateur à supprimer et échappe les caractères spéciaux
    $addsoctouser = htmlspecialchars($_POST["addsoctouser"]); // Récupère l'utilisateur à supprimer et échappe les caractères spéciaux

    try {
        // Prépare la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM usersociete WHERE userID = ? AND societeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $usertosoc);
        $stmt->bindParam(2, $addsoctouser);
        $stmt->execute();

        header("Location: admin.php"); // Redirection vers la page admin
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la société de l'utilisateur': " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression";
    }
}

// Gestion de l'ajout d'un agent
if (isset($_POST['addagent'])) {
    $nom = htmlspecialchars($_POST["agent"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT nom FROM agent WHERE nom = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $nom);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "L'agent existe déjà";
    } else {
        // Insertion d'un nouvel agent dans la base de données
        try {
            $sql = "INSERT INTO agent (nom) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de l'agent : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removeagent'])) {
    $nomagent = htmlspecialchars($_POST["suppagent"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM agent WHERE nom = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $nomagent);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'agent : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de l'agent";
    }
}

// Gestion de l'ajout d'une ligne
if (isset($_POST['addligne'])) {
    $ligne = htmlspecialchars($_POST["ligne"]); // Échappement des données
    $reseau = htmlspecialchars($_POST["reseauadd"]); // Échappement des données

    // Vérifie si la ligne existe déjà dans la base de données
    $checksql = "SELECT num FROM ligne WHERE num = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $ligne);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "La ligne existe déjà";
    } else {
        // Insertion d'une nouvelle ligne dans la base de données
        try {
            $sql = "INSERT INTO ligne (num,reseau) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $ligne);
            $stmt->bindParam(2, $reseau);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la ligne : " . $e->getMessage());
            $existinguser = $e."Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}
// Gestion de la suppression d'une ligne
if (isset($_POST['removeligne'])) {
    $numligne = htmlspecialchars($_POST["ligne"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM ligne WHERE num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $numligne);
        $stmt->execute();

    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la ligne : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de la ligne";
    }

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM service WHERE ligne = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $numligne);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la ligne : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression des services associés";
    }
}

// Gestion de l'ajout d'une ligne
if (isset($_POST['addservice'])) {
    $service = htmlspecialchars($_POST["service"]); // Échappement des données
    $ligneassoc = htmlspecialchars($_POST["ligneassoc"]); // Échappement des données

    // Vérifie si la ligne existe déjà dans la base de données
    $checksql = "SELECT num FROM service WHERE num = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $service);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "Ce service existe déjà";
    } else {
        // Insertion d'une nouvelle ligne dans la base de données
        try {
            $sql = "INSERT INTO service (num,ligne) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $service);
            $stmt->bindParam(2, $ligneassoc);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la ligne : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'une ligne
if (isset($_POST['removeservice'])) {
    $numserv = htmlspecialchars($_POST["numserv"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM service WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $numserv);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la ligne : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de la ligne";
    }
}
// Gestion de l'ajout d'un agent
if (isset($_POST['addcommune'])) {
    $nom = htmlspecialchars($_POST["commune"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT nom FROM commune WHERE nom = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $nom);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "La commune existe déjà";
    } else {
        // Insertion d'une nouvelle commune dans la base de données
        try {
            $sql = "INSERT INTO commune (nom) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la commune : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removecommune'])) {
    $nomcommune = htmlspecialchars($_POST["suppcommune"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM commune WHERE nom = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $nomcommune);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la commune : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de l'agent";
    }
}
// Gestion de l'ajout d'une nature
if (isset($_POST['addnature'])) {
    $type = htmlspecialchars($_POST["nature"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT type FROM nature WHERE type = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $type);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "La nature existe déjà";
    } else {
        // Insertion d'une nouvelle commune dans la base de données
        try {
            $sql = "INSERT INTO nature (type) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $type);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la nature : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removenature'])) {
    $typenature = htmlspecialchars($_POST["suppnature"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM nature WHERE type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $typenature);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la nature : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de la nature";
    }
}
// Gestion de l'ajout d'un reseau   
if (isset($_POST['addreseau'])) {
    $nom = htmlspecialchars($_POST["reseau"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT nom FROM reseau WHERE nom = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $nom);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "Le réseau existe déjà";
    } else {
        // Insertion d'une nouvelle commune dans la base de données
        try {
            $sql = "INSERT INTO reseau (nom) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du réseau : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removereseau'])) {
    $nom = htmlspecialchars($_POST["suppreseau"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM reseau WHERE nom = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $nom);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du réseau : " . $e->getMessage());
        $existinguser = "Ce réseau ne peut être supprimé car il possède des lignes";
    }
}
if (isset($_POST['addsociete'])) {
    $nom = htmlspecialchars($_POST["societe"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT nom FROM societe WHERE nom = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $nom);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "La société existe déjà";
    } else {
        // Insertion d'une nouvelle commune dans la base de données
        try {
            $sql = "INSERT INTO societe (nom) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la société : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removesociete'])) {
    $nom = htmlspecialchars($_POST["suppsociete"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM societe WHERE nom = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $nom);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la société : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de la société";
    }
}
if (isset($_POST['addvehicule'])) {
    $immat = htmlspecialchars($_POST["immatriculation"]); // Échappement des données
    $societe = htmlspecialchars($_POST["societevehic"]); // Échappement des données
    $numparc = htmlspecialchars($_POST["numparc"]); // Échappement des données

    // Vérifie si l'agent existe déjà dans la base de données
    $checksql = "SELECT immatriculation FROM parc WHERE immatriculation = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $immat);
    $stmt->execute();

    $checksql2 = "SELECT num FROM parc WHERE num = ?";
    $stmt2 = $conn->prepare($checksql2);
    $stmt2->bindParam(1, $numparc);
    $stmt2->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "Cet immatriculation est déja enregistrée";
    } elseif ($stmt2->rowCount() > 0) {
        $existinguser = "Ce numéro de parc est déja attribué";
    } else {
        // Insertion d'une nouvelle commune dans la base de données
        try {
            $sql = "INSERT INTO parc (num,societeID,immatriculation ) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $numparc);
            $stmt->bindParam(2, $societe);
            $stmt->bindParam(3, $immat);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la société : " . $e->getMessage());
            $existinguser = error_log("Erreur lors de l'ajout de la société : " . $e->getMessage());
        }
    }
}

// Gestion de la suppression d'un agent
if (isset($_POST['removevehicule'])) {
    $immat = htmlspecialchars($_POST["suppimmat"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM parc WHERE immatriculation = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $immat);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la société : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression du véhicule";
    }
}
if(isset($_POST['editvehicule'])) {
    if(isset($_POST['editimmat']) && empty($_POST['editnum']) && empty($_POST['editsoc'])) {
        try {
            // Retrieve values from the form
            $immat = $_POST['editimmat'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update the immatriculation
            $editveh = "UPDATE parc SET immatriculation = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $immat);
            $stmt->bindParam(2, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Cette immatriculation est déjà enregistrée";
        }

    } elseif (empty($_POST['editimmat']) && isset($_POST['editnum']) && empty($_POST['editsoc'])) {
        try {
            $editnum = $_POST['editnum'];
            $vehitoedit = $_POST['vehitoedit'];
        
            $editveh = "UPDATE parc SET num = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
            
            // Bind parameters
            $stmt->bindParam(1, $editnum);
            $stmt->bindParam(2, $vehitoedit);
            
            // Execute the statement
            $stmt->execute();
        
            // Redirect after successful execution
            header("Location: admin.php");
            exit(); // It's a good idea to call exit() after header redirect to stop further script execution.
        } catch (PDOException $e) {
            $existinguser = "Ce numéro de parc est déjà attribué";
        }

    }  elseif (empty($_POST['editimmat']) && empty($_POST['editnum']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $editsoc = $_POST['editsoc'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update the societeID
            $editveh = "UPDATE parc SET societeID = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
        
            // Bind the parameters
            $stmt->bindParam(1, $editsoc);
            $stmt->bindParam(2, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser = "Une erreur est survenue";
        }

    }  elseif (isset($_POST['editimmat']) && isset($_POST['editnum']) && empty($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $immat = $_POST['editimmat'];
            $editnum = $_POST['editnum'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update immatriculation and num
            $editveh = "UPDATE parc SET immatriculation = ?, num = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
        
            // Bind the parameters
            $stmt->bindParam(1, $immat);
            $stmt->bindParam(2, $editnum);
            $stmt->bindParam(3, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser = "L'immatriculation ou le numéro de parc est déjà attribué";
        }
        

    }  elseif (isset($_POST['editimmat']) && empty($_POST['editnum']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $immat = $_POST['editimmat'];
            $editsoc = $_POST['editsoc'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update immatriculation and societeID
            $editveh = "UPDATE parc SET immatriculation = ?, societeID = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
        
            // Bind the parameters
            $stmt->bindParam(1, $immat);
            $stmt->bindParam(2, $editsoc);
            $stmt->bindParam(3, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser ="Cette immatriculation est déjà enregistrée";
        }
        

    } elseif (empty($_POST['editimmat']) && isset($_POST['editnum']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $editnum = $_POST['editnum'];
            $editsoc = $_POST['editsoc'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update num and societeID based on immatriculation
            $editveh = "UPDATE parc SET num = ?, societeID = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
        
            // Bind the parameters
            $stmt->bindParam(1, $editnum);
            $stmt->bindParam(2, $editsoc);
            $stmt->bindParam(3, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Ensure the script stops after redirect
        } catch (PDOException $e) {
            // Handle any exception that occurs and display the error message
            $existinguser = "Ce numéro de parc est déjà attribué";
        }
        
    } else {
        try {
            // Retrieve the posted values
            $immat = $_POST['editimmat'];
            $editnum = $_POST['editnum'];
            $editsoc = $_POST['editsoc'];
            $vehitoedit = $_POST['vehitoedit'];
        
            // Prepare the SQL query to update immatriculation, num, and societeID based on immatriculation
            $editveh = "UPDATE parc SET immatriculation = ?, num = ?, societeID = ? WHERE immatriculation = ?";
            $stmt = $conn->prepare($editveh);
        
            // Bind the parameters
            $stmt->bindParam(1, $immat);
            $stmt->bindParam(2, $editnum);
            $stmt->bindParam(3, $editsoc);
            $stmt->bindParam(4, $vehitoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Ensure the script stops after redirect
        } catch (PDOException $e) {
            // Handle any exception that occurs and display the error message
            $existinguser = "L'immatriculation ou le numéro de parc est déjà attribué";
        }
    }

}
if(isset($_POST['edituser'])) {
    if(isset($_POST['editrole']) && empty($_POST['editpass']) && empty($_POST['editsoc'])) {
        try {
            // Retrieve values from the form
            $editrole = $_POST['editrole'];
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update the immatriculation
            $edituser = "UPDATE users SET role = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $editrole);
            $stmt->bindParam(2, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Cet identifiant est déjà attribué";
        }

    } elseif (empty($_POST['editrole']) && isset($_POST['editpass']) && empty($_POST['editsoc'])) {
        try {
            // Retrieve values from the form
            $editpass = $_POST['editpass'];
            $hashedPassword = password_hash($editpass, PASSWORD_BCRYPT);
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update the immatriculation
            $edituser = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $hashedPassword);
            $stmt->bindParam(2, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Une erreur est survenue";
        }

    }  elseif (empty($_POST['editrole']) && empty($_POST['editpass']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve values from the form
            $editsoc = $_POST['editsoc'];
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update the immatriculation
            $edituser = "UPDATE users SET societe = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $editsoc);
            $stmt->bindParam(2, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Une erreur est survenue";
        }

    }  elseif (isset($_POST['editrole']) && isset($_POST['editpass']) && empty($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $editrole = $_POST['editrole'];
            $editpass = $_POST['editpass'];
            $hashedPassword = password_hash($editpass, PASSWORD_BCRYPT);
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update immatriculation and num
            $edituser = "UPDATE users SET role = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
        
            // Bind the parameters
            $stmt->bindParam(1, $editid);
            $stmt->bindParam(2, $hashedPassword);
            $stmt->bindParam(3, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the messagee
            $existinguser = "L'identifiant est déjà attribué";
        }
        

    }  elseif (isset($_POST['editrole']) && empty($_POST['editpass']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $editrole = $_POST['editrole'];
            $editsoc = $_POST['editsoc'];
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update immatriculation and num
            $edituser = "UPDATE users SET role = ?, societe = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
        
            // Bind the parameters
            $stmt->bindParam(1, $editrole);
            $stmt->bindParam(2, $editsoc);
            $stmt->bindParam(3, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser = "L'identifiant est déjà attribué";
        }
        

    } elseif (empty($_POST['editrole']) && isset($_POST['editpass']) && isset($_POST['editsoc'])) {
        try {
            // Retrieve the posted values
            $editpass = $_POST['editpass'];
            $hashedPassword = password_hash($editpass, PASSWORD_BCRYPT);
            $editsoc = $_POST['editsoc'];
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update immatriculation and num
            $edituser = "UPDATE users SET password = ?, societe = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
        
            // Bind the parameters
            $stmt->bindParam(1, $hashedPassword);
            $stmt->bindParam(2, $editsoc);
            $stmt->bindParam(3, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser = "Une erreur est survenue";
        }
        
    } else {
        try {
            // Retrieve the posted values
            $editrole = $_POST['editrole'];
            $editpass = $_POST['editpass'];
            $hashedPassword = password_hash($editpass, PASSWORD_BCRYPT);
            $editsoc = $_POST['editsoc'];
            $usertoedit = $_POST['usertoedit'];
        
            // Prepare the SQL query to update immatriculation and num
            $edituser = "UPDATE users SET role = ?, password = ?, societe = ? WHERE id = ?";
            $stmt = $conn->prepare($edituser);
        
            // Bind the parameters
            $stmt->bindParam(1, $editrole);
            $stmt->bindParam(2, $hashedPassword);
            $stmt->bindParam(3, $editsoc);
            $stmt->bindParam(4, $usertoedit);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after successful update
            header("Location: admin.php");
            exit(); // Ensure the script stops executing after the redirect
        } catch (PDOException $e) {
            // Handle any error that occurs and display the message
            $existinguser = "Cet identifiant est déjà attribué";
        }
    }

}

// Gestion de l'ajout d'un email

if (isset($_POST['addmailsociete'])) {
    $societe = htmlspecialchars($_POST["societemail"]); // Échappement des données
    $email = htmlspecialchars($_POST["addemail"]); // Échappement des données

    // Vérifie si la ligne existe déjà dans la base de données
    $checksql = "SELECT email FROM emails WHERE email = ? and societeID = ?";
    $stmt = $conn->prepare($checksql);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $societe);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $existinguser = "L'email existe déjà pour cette société";
    } else {
        // Insertion d'une nouvelle ligne dans la base de données
        try {
            $sql = "INSERT INTO emails (email,societeID) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $societe);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la ligne : " . $e->getMessage());
            $existinguser = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}

// Gestion de la suppression d'un email
if (isset($_POST['removeemail'])) {
    $email = htmlspecialchars($_POST["suppemail"]);
    $societe = htmlspecialchars($_POST["suppemailsoc"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM emails WHERE email = ? AND societeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $societe);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de la ligne : " . $e->getMessage());
        $existinguser = "Erreur lors de la suppression de l'email'";
    }
}

if(isset($_POST['editservice'])) {
    if(isset($_POST['newservnum']) && empty($_POST['newligneserv'])) {

        // Retrieve values from the form
        $idserv = $_POST['idserv'];
        $servnum = $_POST['newservnum'];
        
        try {
        
            // Prepare the SQL query to update the immatriculation
            $editserv = "UPDATE service SET num = ? WHERE id = ?";
            $stmt = $conn->prepare($editserv);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $servnum);
            $stmt->bindParam(2, $idserv);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Une erreur est survenue";
        }

    } elseif(empty($_POST['newservnum']) && isset($_POST['newligneserv'])) {

        // Retrieve values from the form
        $idserv = $_POST['idserv'];
        $ligneserv = $_POST['newligneserv'];

        try {
        
            // Prepare the SQL query to update the immatriculation
            $editserv = "UPDATE service SET ligne = ? WHERE id = ?";
            $stmt = $conn->prepare($editserv);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $ligneserv);
            $stmt->bindParam(2, $idserv);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Une erreur est survenue";
        } 
    } elseif(isset($_POST['newservnum']) && isset($_POST['newligneserv'])) {
        $idserv = $_POST['idserv'];
        $servnum = $_POST['newservnum'];
        $ligneserv = $_POST['newligneserv'];

        try {
            // Retrieve the posted values
        
            // Prepare the SQL query to update the immatriculation
            $editserv = "UPDATE service SET num = ? , ligne = ? WHERE id = ?";
            $stmt = $conn->prepare($editserv);
            
            // Bind parameters to the query
            $stmt->bindParam(1, $servnum);
            $stmt->bindParam(2, $ligneserv);
            $stmt->bindParam(3, $idserv);
        
            // Execute the query
            $stmt->execute();
        
            // Redirect to the admin page after the update
            header("Location: admin.php");
            exit(); // Make sure the script stops after the redirect
        } catch (PDOException $e) {
            // Handle the exception and display an error message
            $existinguser = "Une erreur est survenue";
        } 

    } else {}
}

// Gestion de la suppression d'un email
if (isset($_POST['anonymisation'])) {
    $conducteur = htmlspecialchars($_POST["nomconducteur"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "UPDATE ticket SET conducteur = 'XXXX', servicevehi = 'XXXX' WHERE conducteur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $conducteur);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'anonymisation : " . $e->getMessage());
        $existinguser = "Erreur lors de l'anonymisation";
    }
}

// Gestion de la suppression d'un email
if (isset($_POST['supptickets'])) {
    $interval = htmlspecialchars($_POST["interval"]);

    try {
        // Prépare la requête pour supprimer l'agent
        $sql = "DELETE FROM ticket WHERE datecreationticket < CURDATE() - INTERVAL ? YEAR
";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $interval);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'anonymisation : " . $e->getMessage());
        $existinguser = "Erreur lors de l'anonymisation";
    }
}

?>