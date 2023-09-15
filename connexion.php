<!DOCTYPE html>
<?php
session_start();

class ConnexionMessages {
    // Lorsque l'utilisateur n'est pas trouvé, index.php va nous renvoyer une séquence $_GET avec un élément et la méthode va nous renvoyer un message.
    public function notFound() {
        // On vérifie d'abord si $_GET['conn'] existe
        if (isset($_GET['conn']) && !empty($_GET['conn'])) {
            // Et qu'il est egal à notfound
            if($_GET['conn'] === 'notfound') {
                echo 'Utilisateur ou Mot de passe incorrect';
                header('refresh: 1;url= ./connexion.php');
            }
        }
    }
}
$msg = new ConnexionMessages();

?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Se connecter - Assurance tourisqte</title>
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
                            <div class="blockColor"></div>
                            <div class="contentBx">
                                <h3>Connexion</h3>
                                <span style="color: red;"></span>
                                <form action="index.php" method="POST">
                                    <fieldset>
                                        <div class="field">
                                            <label for="user">Nom d'utilisateur</label> <br>
                                            <input type="text" id="user" name="user" value="" required>
                                        </div>
                                        <div class="field">
                                            <label for="password">Mot de Passe</label> <br>
                                            <input type="password" id="password" name="password" value="" required>
                                            <input type="hidden" name="csrf_token" value="token">
                                        </div>
                                        <a href="https://sagefamily.fr/wp-content/uploads/2021/08/Publi-Facebook-7.png">Mot de passe oublié?</a><br>
                                        <?= $msg->notFound(); ?>
                                        <button>Connexion</button> 
                                    </fieldset>
                                </form>
                            </div>
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