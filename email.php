<?php


// Charger automatiquement les dépendances de Composer
require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

// Charger les variables d'environnement depuis le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


// Initialiser PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres du serveur SMTP
    $mail->isSMTP();                         
    $mail->SMTPOptions = array(
       'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true,
        )
    );
    $mail->CharSet = 'UTF-8';
    $mail->Host = $_ENV['SMTP'];  // Serveur SMTP Office365
    $mail->SMTPAuth = true;              // Authentification SMTP activée
    $mail->Username = $_ENV['MAIL_USERNAME'];  // Adresse e-mail depuis .env
    $mail->Password = $_ENV['MAIL_PASSWORD'];  // Mot de passe depuis .env
    $mail->SMTPSecure = $_ENV['TLS'];  // Utilisation de TLS
    $mail->Port = $_ENV['PORT'];  // Port SMTP pour TLS

    // Expéditeur et destinataire
    $mail->setFrom($_ENV['MAIL_USERNAME'], $userID . ", Exploitation " . $serviceagent);
            // Ajouter dynamiquement les adresses e-mail
            $mail->addAddress($_ENV['MAIL_REGUL']);
            foreach ($emailArray as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress(trim($email));
                } else {
                    echo "Adresse e-mail invalide: $email";
                }
            }

    // Contenu de l'email
    $mail->isHTML(true);                                     // Activer HTML
    $mail->Subject = "Nouvel incident: ". $nature . ", le " . $formateddateevent;
    $mail->Body = "
    <div style='font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px;'>
        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Date de création :</strong> <span style='color: #555;'>".$formateddate_now_string."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Créé par :</strong> <span style='color: #555;'>".$userID . ', Exploitation ' . $serviceagent . "</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Nom agent :</strong> <span style='color: #555;'>".$agent . "</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Réseau :</strong> <span style='color: #555;'>".$reseau."</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Ligne :</strong> <span style='color: #555;'>".$ligne."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>N° de service :</strong> <span style='color: #555;'>".$servicevehi."</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Commune :</strong> <span style='color: #555;'>".$communevehi."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Sens du véhicule :</strong> <span style='color: #555;'>".$sensvehi."</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>N° de parc :</strong> <span style='color: #555;'>".$parc."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Immatriculation :</strong> <span style='color: #555;'>".$immat."</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Transporteur :</strong> <span style='color: #555;'>".$societe."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Date de l'incident :</strong> <span style='color: #555;'>". $formateddateevent . " à " . $formatedtimeevent . "</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Nature :</strong> <span style='color: #555;'>".$nature."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Conducteur :</strong> <span style='color: #555;'>".$conducteur."</span>
            </div>
            <div style='background-color: #ffffff; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Détails :</strong> <span style='color: #555;'>".$details."</span>
            </div>
            <div style='background-color: #f9f9f9; margin-bottom: 10px; padding: 10px;'>
                <strong style='font-size: 18px;'>Opération réalisée :</strong> <span style='color: #555;'>".$operation."</span>
            </div>
        </div>
    </div>
";





            $mail->AltBody = "Date de création : ".$formateddate_now_string."
                    Créé par : ".$userID . ', Exploitation ' . $serviceagent."
                    Réseau : ".$reseau."
                    Ligne : ".$ligne."
                    N° de service : ".$servicevehi."
                    Commune : ".$communevehi."
                    Sens du véhicule : ".$sensvehi."
                    N° de parc : ".$parc."
                    Immatriculation : ".$immat."
                    Transporteur : ".$societe."
                    Date de l'incident : ".$formateddateevent." à ".$formatedtimeevent."
                    Nature : ".$nature."
                    Conducteur : ".$conducteur."
                    Détails : ".$details."
                    Opération réalisée : ".$operation;


    // Envoyer l'email
    if(!$mail->send()){
        echo 'Le message n\'a pas pu être envoyé.';
        echo 'Erreur du Mailer : ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "L'email n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
}
?>