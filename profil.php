<!DOCTYPE html>
<?php
session_start();
require_once './bdd-connexion/Database.php';
class Profil Extends Database {
    
    public function __construct() {
        parent::__construct();
        
    }

    public function initInfoProfil(): array {
       $query = $this->connexion->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
       $query->bindValue(':login', $_SESSION['user']);
       $query->bindValue(':password', $_SESSION['password']);
       $query->execute();
       $data = $query->fetch(PDO::FETCH_ASSOC);
       return $data;
    }
    public function securePasswordUpdate() {
        if (isset($_POST['modpwd']) && !empty($_POST['modpwd']) && isset($_POST['modnewpwd']) && !empty($_POST['modnewpwd']) && isset($_POST['vermodnewpwd']) && !empty($_POST['vermodnewpwd'])) {
            if ($_POST['modpwd'] !== $_POST['modnewpwd'] && $_POST['modpwd'] !== $_POST['vermodnewpwd']) {
                if ($_POST['modnewpwd'] === $_POST['vermodnewpwd']) {
                    $mquery = $this->connexion->prepare('UPDATE user SET password = :password WHERE login = :login');
                    $mquery->bindValue(':password', htmlspecialchars($_POST['vermodnewpwd']));
                    $mquery->bindValue(':login', $_SESSION['user']);
                    $_SESSION['password'] = htmlspecialchars($_POST['vermodnewpwd']); 
                    $mquery->execute();
                    return 'Changement du mot de passe réussi !';
                }
                else {
                    return 'Attention les nouveaux mot de passe ne correspondent pas !';
                }
            }
            else {
                return 'Attention les mots de passe (ancien & nouveau) sont les mêmes veuillez les modifier correctement';
            }
        }
    }
    public function session() {
        if(!$_SESSION) {
            header('location: ./index.php');
        }
    }
}
$profil = new Profil();
$profil->session();
echo $profil->securePasswordUpdate();
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Votre profil - Assurance tourisqte</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body>
        <header>
            <a href="#" class="logo">Assurance tourisqte</a>
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
                <div class="container-login blur">
                    <section class="login">
                        <div class="content">
                            <section id="secLog" class="login">
                                <div class="content">
                                    <div class="blockColor"></div>
                                    <div class="contentBx justify">
                                        <h3>Connexion</h3>
                                        <p>Nom :  <?= $profil->initInfoProfil()['lastname'] ?></p>
                                        <p>Prénom : <?= $profil->initInfoProfil()['firstname'] ?> </p>
                                        <p>Nom d'utilisateur : <?= $profil->initInfoProfil()['login'] ?> </p>
                                        <form action="./profil.php" method="POST">
                                            <details>
                                                <summary>Modifier le mot de passe -></summary>
                                                <p>Ancien mot de passe :</p>
                                                <input type="password" id="modpwd" name="modpwd" placeholder="Entrez votre ancien mot de passe" required>
                                                <p>Nouveau mot de passe :</p>
                                                <input type="password" id="modnewpwd" name="modnewpwd" placeholder="Entrez votre nouveau mot de passe" required>
                                                <p>Vérifiez à nouveau votre nouveau mot de passe :</p>
                                                <input type="password" id="vermodnewpwd" name="vermodnewpwd" placeholder="Réitérez" required>
                                                <button>Valider le changement</button>
                                            </details>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <footer>
            <div class="block">
                <h3>Heure d'ouverture</h3>
                <p>
                    Lundi: Fermé <br>
                    Mardi-Mercredi : 9h - 18h<br>
                    Jeudi-Vendredi : 9h - 18h<br>
                    Samedi-Dimanche : 9h - 12h
                </p>
            </div>

            <div class="block">
                <h3>Contact</h3>
                <div class="adress">
                    <p>
                        13 Bd Galopin Renoue<br>
                        Maine-et-Loire,<br>
                        49000 Angers<br>
                        01.02.03.45.47
                    </p>
                </div>
            </div>

            <div class="block">
                <h3>Social networks</h3>
                <div class="social-network">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                </div>
            </div>
        </footer>
    </body>
</html>