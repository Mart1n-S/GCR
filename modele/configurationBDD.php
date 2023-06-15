<?php
$bddDNS = 'mysql:host=Nom_Serveur;dbname=Nom_BDD';
$bddUser = 'Nom_User';
$bddMotDePasse = 'Password';
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];
