<!DOCTYPE html>
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
                    <li><a href="#">Accueil</a></li>
                    <!-- if dollar SESSION (profil ou (inscripton & connexion) ici pour savoir si on est connecté ou pas  -->
                    <li><a href="#">Profil</a></li>
                    <!-- if SESSION existant -->
                    <li><a href="#">Modifier son profil</a></li>
                    <!-- if dollar session existant + status admin -->
                    <li><a href="#">Outils Administrateur</a></li>
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
                                        <p>Nom :  <?php /*$user->getLname()*/ ?></p>
                                        <p>Prénom : <?php /*$user->getFname()*/ ?> </p>
                                        <p>Email : <?php /*$user->getEmail()*/ ?> </p>
                                        <a href="#">Modifier mot de Passe</a>
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