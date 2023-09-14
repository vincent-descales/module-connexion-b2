<!DOCTYPE html>
<?php
require_once './bdd-connexion/Database.php';
session_start();
class Admin extends Database {
    public function __construct() {
        parent::__construct();
        
    }
    public function isnotAdmin() {
        if(!$_SESSION) {
            header('location: ./index.php');
        }
        if($_SESSION['user'] !== "admiN1337$" && $_SESSION['password'] !== "admiN1337$") {
            header('location: ./index.php');
        }
    }
    public function everyone() {
        $query = $this->connexion->prepare('SELECT * FROM user');
        //var_dump($query);
        $query->execute();
        $data = $query->fetchAll();

        if($data) {
            foreach ($data as $dat) {
                echo $dat['id'] . $dat['login'];
            }
            var_dump($data);
            
            
        }
    }
}
$admin = new Admin();
$admin->isnotAdmin();
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrer les pigeons - Assurance tourisqte</title>
        <link rel="stylesheet" href="./css/styles.css">

    </head>
    <body>
        <header>
            <a href="" class="logo">Assurance tourisqte</a>
            <div class="block-search">
                <input type="text" name="q-search" id="search"/>

                <ul id="list-search">
                </ul>
            </div>

            <div class="toggle">
                <ul>
                <li><a href="./index.php">Accueil</a></li>
                    <!-- if dollar SESSION est vide (par défault tableau vide)  -->
                    <?php if(!$_SESSION): ?>
                    <li><a href="./connexion.php">Connexion</a></li>
                    <li><a href="./inscription.php">Inscription</a></li>
                    <?php endif; ?>
                    <!-- if SESSION rempli -->
                    <?php if($_SESSION): ?>
                    <li><a href="./profil.php">Profil</a></li>
                    <li><a href="./index.php?conn=disconnect">Se déconnecter</a></li>
                    <!-- if dollar session existant + status admin du premier utilisateur -->
                    <?php if($_SESSION['user'] === "admiN1337$" && $_SESSION['password'] === "admiN1337$"): ?>
                    <li><a href="./admin.php">Outils Administrateur</a></li>
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
        <main>
            <div class="container">
                <div id="users">
                    <h1>Administration des pigeons (oui on aime la moula et l'assurance ne vous aidera pas).</h1>
                    <h2>Listes des utilisateurs :</h2>
                    <div id="jsonutilisateur">
                        <?php $admin->everyone(); ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>