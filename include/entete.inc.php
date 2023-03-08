<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="styles/gcr.css" rel="stylesheet">
    <title>GSB : Suivi de la Visite médicale </title>
</head>

<body>
    <div class="topTitre">
        <h1><img src="images\logo.jpg">Gestion des comptes rendus de visite</h1>
    </div>

    <div class="menuNavigation">
        <p id="informationsUtilisateur">
            <?php
            echo $_SESSION['prenomUser'] . ' ' . $_SESSION['nomUser'] . '<br>';
            echo $_SESSION['roleUser'] . '<br>';
            echo 'Région ' . $_SESSION['regionUser'];
            ?>
        </p>
        <h2>Outils</h2>
        <ul>
            <li>Comptes-Rendus</li>
            <ul>
                <li><a href="index.php?action=10">Nouveaux</a></li>

                <li>Consulter</li>
            </ul>

            <li>Consulter</li>
            <ul>
                <li><a href="index.php?action=15">Médicaments</a></li>
                <li><a href="index.php?action=30">Praticiens</a></li>
                <li><a href="index.php?action=35">Autres visiteurs</a></li>
            </ul>
            <li>Déconnexion</li>
            <ul>
                <li><a href="index.php?action=40">Fermer la session</a></li>
            </ul>
        </ul>
    </div>
    <div class="containerElement">