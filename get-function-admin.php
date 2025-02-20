<?php 

// Récupère la liste des sociétés depuis la base de données
$getsociete = "SELECT id, nom FROM societe";
$stmt = $conn->prepare($getsociete);
$stmt->execute();
try {
    $societe = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les sociétés dans $societe
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log, éviter l'affichage direct
    exit;
}

// Récupère la liste des utilisateurs depuis la base de données
$getuser = "SELECT users.id, users.role, societe.nom FROM users INNER JOIN societe on societe.id = users.societe";
$stmt = $conn->prepare($getuser);
$stmt->execute();
try {
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les utilisateurs dans $users
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

// Récupère la liste des agents depuis la base de données
$getagent = "SELECT nom FROM agent";
$stmt = $conn->prepare($getagent);
$stmt->execute();
try {
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

// Récupère la liste des agents depuis la base de données
$getcommune = "SELECT nom FROM commune";
$stmt = $conn->prepare($getcommune);
$stmt->execute();
try {
    $communes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

// Récupère la liste des reseaux depuis la base de données
$getreseau = "SELECT * FROM reseau";
$stmt = $conn->prepare($getreseau);
$stmt->execute();
try {
    $reseaux = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}
$getligne = "SELECT ligne.num, reseau.nom FROM ligne INNER JOIN reseau on reseau.id = ligne.reseau order by reseau asc";
$stmt = $conn->prepare($getligne);
$stmt->execute();
try {
    $ligne = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

// Récupération des lignes disponibles pour le select (si ce n'est pas déjà fait)
$sql_lignes = "SELECT * FROM ligne ORDER BY num ASC"; // Sélectionner les lignes distinctes
$stmt_lignes = $conn->prepare($sql_lignes);
$stmt_lignes->execute();
$lignes = $stmt_lignes->fetchAll(PDO::FETCH_ASSOC);

// Récupération de tous les services
$getservice = "SELECT * FROM service ORDER BY ligne, num ASC";
$stmt = $conn->prepare($getservice);
try {
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les services dans $services
} catch (PDOException $e) {
    error_log("Error fetching services: " . $e->getMessage());
    exit;
}

// Récupération de tous les services
$getnumserv = "SELECT id,num FROM service ORDER BY num ASC";
$stmt = $conn->prepare($getnumserv);
try {
    $stmt->execute();
    $numserv = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les services dans $services
} catch (PDOException $e) {
    error_log("Error fetching services: " . $e->getMessage());
    exit;
}

// Récupère la liste des natures depuis la base de données
$getnature = "SELECT type FROM nature ORDER BY type asc";
$stmt = $conn->prepare($getnature);
$stmt->execute();
try {
    $natures = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}
// Récupère la liste des societes depuis la base de données
$getsociete = "SELECT id,nom FROM societe";
$stmt = $conn->prepare($getsociete);
$stmt->execute();
try {
    $societes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}
// Récupère la liste des societes depuis la base de données
$getimmatr = "SELECT immatriculation FROM parc";
$stmt = $conn->prepare($getimmatr);
$stmt->execute();
try {
    $immatriculations = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

$getvehicule = "SELECT * FROM parc";
$stmt = $conn->prepare($getvehicule);
$stmt->execute();
try {
    $vehitable = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

$getsocieteuser = "SELECT DISTINCT usersociete.userID, usersociete.societeID, societe.nom FROM usersociete INNER JOIN societe on usersociete.societeID = societe.id ORDER BY usersociete.userID asc";
$stmt = $conn->prepare($getsocieteuser);
$stmt->execute();
try {
    $societesusers = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

$getemails = "SELECT emails.email, emails.societeID, societe.nom FROM emails INNER JOIN societe on societe.id = emails.societeID ORDER BY emails.societeID asc";
$stmt = $conn->prepare($getemails);
$stmt->execute();
try {
    $emails = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

$getemailtosupp = "SELECT DISTINCT emails.email FROM emails ORDER BY emails.email asc";
$stmt = $conn->prepare($getemailtosupp);
$stmt->execute();
try {
    $emailtosupp = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}
$getsocietetosupp = "SELECT DISTINCT emails.societeID, societe.nom FROM emails INNER JOIN societe on societe.id = emails.societeID ORDER BY emails.societeID asc";
$stmt = $conn->prepare($getsocietetosupp);
$stmt->execute();
try {
    $societetosupp = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

$getconducteur = "SELECT DISTINCT conducteur FROM ticket WHERE conducteur NOT IN ('XXXX')";
$stmt = $conn->prepare($getconducteur);
$stmt->execute();
try {
    $conducteur = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les agents dans $agents
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Erreur en log
    exit;
}

?>