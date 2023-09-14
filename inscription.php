<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>S'inscrire - Assurance tourisqte</title>
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
                            <div class="blockColor"></div>
                            <div class="contentBx">
                                <h3>Inscription</h3>
                                <h4>Vous n'avez (quasiment) besoin de rien !</h4>
                                <span style="color: red;"></span>
                                <form action="index.php?url=securityRegister" method="POST">
                                    <fieldset>
                                        <div class="field">
                                            <label for="lastName">Nom</label> <br>
                                            <input type="text" id="ilastname" name="ilastname" value="" required>
                                        </div>
                                        <div class="field">
                                            <label for="firstName">Prénom</label> <br>
                                            <input type="text" id="ifirstname" name="ifirstname" value="" required>
                                        </div>
                                        <div class="field">
                                            <label for="user">Nom d'utilisateur</label> <br>
                                            <input type="text" id="iuser" name="iuser" value="" required>
                                        </div>
                                        <div class="field">
                                            <label for="password">Mot de Passe</label> <br>
                                            <input type="password" id="ipassword" name="ipassword" value="" required>
                                            <!-- <input type="hidden" name="csrf_token" value=""> -->
                                        </div>
                                        <div class="field">
                                            <label for="password">Confirmer le mot de passe</label> <br>
                                            <input type="password" id="ipasswordre" name="ipasswordre" value="" required>
                                            <!-- <input type="hidden" name="csrf_token" value=""> -->
                                        </div>
                                        <button>Inscription</button>
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