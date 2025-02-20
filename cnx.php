<?php

            // Charger Composer autoload (si vous utilisez Composer)
            require_once 'vendor/autoload.php';

            // Charger les variables d'environnement depuis le fichier .env
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            // Accéder aux variables d'environnement
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $dbUsername = $_ENV['DB_USERNAME'];
            $dbPassword = $_ENV['DB_PASSWORD'];
            
            //On essaie de se connecter
            try{
                $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
        ?>