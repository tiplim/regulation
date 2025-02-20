
<?php
    session_start();
    require("header-function.php");
    $redirectUrl = 'login.php';
    if(!isset($_SESSION['userID'])){
        header("Location: $redirectUrl");
    exit();
};

// Charger automatiquement les dépendances de Composer
require 'vendor/autoload.php'; 
use Dotenv\Dotenv;
// Charger les variables d'environnement depuis le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mentionslegales.css">
</head>
<body>
    <div class='texte'>
        <p>
        <h3>POLITIQUE DE CONFIDENTIALITÉ</h3>

Cette politique de confidentialité décrit comment nous collectons, utilisons et protégeons vos informations personnelles lorsque vous utilisez l'application "REGULATION". Nous nous engageons à garantir la sécurité et la confidentialité de vos données. Nous vous invitons à lire attentivement cette politique afin de comprendre comment nous traitons vos informations personnelles.

<h3>1. COLLECTE DES INFORMATIONS PERSONNELLES</h3>

Lors de l'utilisation de l'application "REGULATION", nous collectons certaines informations personnelles limitées, telles que le nom du chauffeur, le nom de l'agent et l'adresse e-mail de diffusion. Ces informations sont nécessaires pour le bon fonctionnement de l'application et le traitement des incidents.

<h3>2. UTILISATION DES INFORMATIONS PERSONNELLES</h3>

Les informations personnelles collectées sont utilisées pour traiter et résoudre les incidents. Cela inclut, entre autres, l'envoi de notifications par e-mail concernant les incidents ainsi que les personnes concernées. Nous nous engageons à ne pas vendre, louer, partager vos informations personnelles avec des tiers à des fins commerciales, ni à les transférer à des sous-traitants, sauf dans le cadre des obligations légales.

<h3>3. BASE LÉGALE DU TRAITEMENT DES DONNÉES</h3>

Nous traitons vos données personnelles principalement sur la base de votre consentement ou pour l'exécution des contrats auxquels vous êtes partie, y compris pour le traitement des incidents relatifs à l'application "REGULATION".

<h3>4. PROTECTION DES INFORMATIONS PERSONNELLES</h3>

Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées pour protéger vos informations personnelles contre toute utilisation, divulgation ou accès non autorisé. Toutefois, bien que nous fassions tout notre possible pour assurer la sécurité de vos données, aucune méthode de transmission via Internet ou de stockage électronique n'est totalement invulnérable, et nous ne pouvons garantir une sécurité absolue.

<h3>5. CONFORMITÉ AU RGPD (RÈGLEMENT GÉNÉRAL SUR LA PROTECTION DES DONNÉES)</h3>

Si vous résidez dans l'Union européenne, vos données personnelles sont protégées par le RGPD. Nous nous engageons à respecter les principes du RGPD en matière de collecte, d'utilisation, de stockage et de protection de vos données personnelles. Nous ne traiterons vos données que sur la base de votre consentement, et elles seront conservées uniquement pour les finalités spécifiées dans cette politique. Vous avez le droit d'accéder à vos données, de les rectifier, de les supprimer, de les transférer et de retirer votre consentement à tout moment. Vous pouvez également limiter le traitement de vos données et exercer votre droit à la portabilité des données.

<h3>6. DURÉE DE CONSERVATION DES DONNÉES</h3>

Nous conservons vos données personnelles aussi longtemps que nécessaire pour la gestion des incidents et pour répondre à des obligations légales ou réglementaires. Une fois les données n'étant plus nécessaires à ces fins, elles seront supprimées.

<h3>7. MODIFICATIONS DE LA POLITIQUE DE CONFIDENTIALITÉ</h3>

Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Les modifications seront effectives dès leur publication sur l'application "REGULATION". En cas de modification substantielle, nous vous informerons par notification dans l'application ou par e-mail. Nous vous encourageons à consulter régulièrement cette politique pour rester informé des mises à jour.

<h3>8. CONTACTEZ-NOUS</h3>

Pour toute question, préoccupation ou demande concernant cette politique de confidentialité ou le traitement de vos données personnelles, veuillez nous contacter à l'adresse suivante : <a style="color:black" href="mailto:<?php echo $_ENV['MAIL_CONTACT_RGPD'] ?>"><?php echo $_ENV['MAIL_CONTACT_RGPD'] ?></a> .

En utilisant l'application "REGULATION", vous acceptez les termes de cette politique de confidentialité, notamment la collecte, l'utilisation et la protection de vos informations personnelles conformément aux dispositions du RGPD.  
        </p>
    </div>
</body>
</html>