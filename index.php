<!DOCTYPE html>
<?php
 require_once './bdd-connexion/Database.php';
 require_once './Model/UserRegister.php';
 session_start();
 class Connexion extends Database {
     public function __construct() {
         parent::__construct();
         
     }
     public function initSecureConnexionAndRegister() {
         
         if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['password']) && !empty($_POST['password'])) {
             try {//On va vérifier à quel utilisateur ici appartien le l'user et le mdp qund il se connecte

                 $newuser = htmlspecialchars($_POST['user']);
                 $newpassword = htmlspecialchars($_POST['password']);
                 $query = $this->connexion->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
                 //var_dump($query);
                 $query->bindValue(':login', $newuser);
                 $query->bindValue(':password', $newpassword);
                 $query->execute();
                 $data = $query->fetch(PDO::FETCH_ASSOC);

                 if($data) {
                     $_SESSION['prenom'] = $newuser;
                     $_SESSION['password'] = $newpassword;
                     echo "Connexion réussie";
                     header('refresh: 1;url= ./index.php');
                 }
                 else { 
                     header('location: ./connexion.php?conn=notfound');
                 }
                 
             } catch (Exception $e) {
                 die($e);
             }
         }
     }
    public function initDisconnect() {
        if ($_GET["conn"] === 'disconnect') {
            session_destroy();
            echo 'Déconnexion réussie !';
            header('refresh: 1;url= ./index.php');
        }
    }
    public function initSecureInscription() {
        $usr = new UserRegister();

        $usr->setLogin(htmlspecialchars($_POST['iuser']));
        $usr->setFirstname(htmlspecialchars($_POST['ifirstname']));
        $usr->setLastname(htmlspecialchars($_POST['ilastname']));
        $usr->setPassword(htmlspecialchars($_POST['ipassword']));
        $usr->setPasswordre(htmlspecialchars($_POST['ipasswordre']));

        if ($usr->getPassword() === $usr->getPasswordre()) {
            $iquery = $this->connexion->prepare("INSERT INTO user (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)");
            $iquery->bindValue(':login', $usr->getLogin());
            $iquery->bindValue(':firstname', $usr->getFirstname());
            $iquery->bindValue(':lastname', $usr->getLastname());
            $iquery->bindValue(':password', $usr->getPassword());
            $iquery->execute();
            echo 'Inscription réussie ! Veuillez vous connecter pour démarrer une session.';
        }
        else {
            header('location: ./inscription.php?inscr=notsamepwd');
        }

            
    }

        /*if (isset($_POST['iuser']) && !empty($_POST['iuser']) && isset($_POST['ipassword']) && !empty($_POST['ipassword'])) {

        } */
}
$conn = new Connexion();
if (isset($_POST['user']) && !empty($_POST['user']) 
&& isset($_POST['password']) && !empty($_POST['password'])) {
    $conn->initSecureConnexionAndRegister();
}
else if (isset($_POST['iuser']) && !empty($_POST['iuser']) 
&& isset($_POST['ipassword']) && !empty($_POST['ipassword'])
&& isset($_POST['ilastname']) && !empty($_POST['ilastname']) 
&& isset($_POST['ifirstname']) && !empty($_POST['ifirstname']) 
&& isset($_POST['ipassword']) && !empty($_POST['ipassword']) 
&& isset($_POST['ipasswordre']) && !empty($_POST['ipasswordre'])) {
    $conn->initSecureInscription();
}

if (isset($_GET['conn']) && !empty($_GET['conn'])){
    $conn->initDisconnect();
}    
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - Assurance tourisqte</title>
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
                    <!-- if dollar SESSION (profil ou (inscripton & connexion) ici pour savoir si on est connecté ou pas  -->
                    <?php if(!$_SESSION): ?>
                    <li><a href="./connexion.php">Connexion</a></li>
                    <li><a href="./inscription.php">Inscription</a></li>
                    <?php endif; ?>
                    <!-- if SESSION existant -->
                    <?php if($_SESSION): ?>
                    <li><a href="./profil.php">Profil</a></li>
                    <li><a href="./index.php?conn=disconnect">Se déconnecter</a></li>
                    <!-- if dollar session existant + status admin -->
                    <li><a href="./admin.php">Outils Administrateur</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
        <main>
            <div class="container">
                <section class="banner">
                    <div class="textBx">
                        <h2>Découvrer l'assurance</h2>
                        <h3>nos assureurs ont du talents</h3>
                        <a href="./inscription.php" class="btn desktop">Vous inscrire !</a>
                        <h3>Ou</h3>
                        <a href="./connexion.php" class="btn desktop">Connectez vous !</a>
                    </div>
                </section>

                <section class="about">
                    <div class="titre">
                        <h2>Une assurance élue meilleure touriste et tout risque depuis 2022 !</h2>
                        <span></span>
                    </div>
                    <div class="content">
                        <div class="contentBx">
                            <h3>Une assurance fière de ses traditions</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam quibusdam optio distinctio,
                                deleniti modi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab minima dolor voluptate voluptatum,
                                similique cumque.
                                Labore quas dignissimos, aperiam exercitationem distinctio dolore nemo recusandae delectus ipsam
                                perferendis est ipsum rem!
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam quibusdam optio distinctio,
                                deleniti modi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab minima dolor voluptate voluptatum,
                                similique cumque.
                                Labore quas dignissimos, aperiam exercitationem distinctio dolore nemo recusandae delectus ipsam
                                perferendis est ipsum rem!
                            </p>
                        </div>
                        <div>
                            <img src="https://static.latribune.fr/1921791/comment-bien-choisir-son-assurance.jpg" class="img"
                                alt="Des mains qui protègent vous et votre famille">
                        </div>
                    </div>
                </section>

                <div class="products">
                    <section class="box-product">
                        <div class="titre">
                            <h2>Nos services phares : tradition</h2>
                        </div>
                        <article>
                            <div class="content-overlay">
                                <img src="./public/assets/img/pexels-polina-tankilevitch-4828368.jpg" alt="">
                                <div class="overlay"></div>
                                <div class="middle">
                                    <div class="text">Ajouter au panier</div>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>

                        <article>
                            <div class="content-overlay">
                                <img src="./public/assets/img/pexels-polina-tankilevitch-4828433.jpg" alt="">
                                <div class="overlay"></div>
                                <div class="middle">
                                    <div class="text">Ajouter au panier</div>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>

                        <article>
                            <div class="content-overlay">
                                <img src="./public/assets/img/pexels-polina-tankilevitch-4828279.jpg" alt="">
                                <div class="overlay"></div>
                                <div class="middle">
                                    <div class="text">Ajouter au panier</div>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>
                        <article>
                            <div class="content-overlay">
                                <img src="./public/assets/img/pexels-polina-tankilevitch-4828358.jpg" alt="">
                                <div class="overlay"></div>
                                <div class="middle">
                                    <div class="text">Ajouter au panier</div>
                                </div>
                            </div>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>
                    </section>
                </div>

                <div class="products">
                    <section class="box-product">
                        <div class="titre">
                            <h2>Sélection nos produits évènementiel</h2>
                        </div>
                        <article>
                            <img src="./public/assets/img/pexels-jill-wellington-3969254.jpg" alt="">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>
                        <article>
                            <img src="./public/assets/img/pexels-roman-odintsov-5897462.jpg" alt="">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>
                        <article>
                            <img src="./public/assets/img/pexels-lina-kivaka-5732158.jpg" alt="">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, consequatur!
                            </p>
                        </article>
                        <a href="#" class="btn">En savoir plus</a>
                    </section>
                </div>

                <div class="awards">
                    <section class="box-awards">
                        <div class="titre">
                            <h2>Nos récompenses</h2>
                            <span></span>
                        </div>
                        <article>
                            <img src="./public/assets/img/pexels-choclatine.jpg" alt="">
                            <div class="column">
                                <p>
                                    Libre a votre créativité de réaliser cette section. Elle a pour but de présenter
                                    le titre du meilleur pain au chocolat/ ou chocolatine (on ne va pas se fâcher).
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magni mollitia nobis
                                    nostrum nesciunt sunt enim, iste minima, natus culpa porro asperiores est accusamus
                                    doloremque nisi. Architecto enim aspernatur quam maiores, minima explicabo nihil veniam.
                                    Maiores sunt hic dolore in voluptatem, mollitia quibusdam delectus tempore quasi non
                                    nisi asperiores quis neque optio, est quam atque dolorem quas, assumenda nemo sed repudiandae.
                                    Corrupti velit reiciendis aliquid sequi quisquam facere perferendis quis ducimus? Doloribus
                                    eum quia sapiente illo qui nam, id impedit hic nisi beatae dolor praesentium quos explicabo.
                                    Nobis incidunt porro ipsum aliquid, nihil laudantium voluptates vero, animi voluptatibus,
                                    accusamus iusto!
                                </p>
                            </div>
                        </article>
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