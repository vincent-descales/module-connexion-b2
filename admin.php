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
    public function showEveryone() {
        $query = $this->connexion->prepare('SELECT * FROM user');
        //var_dump($query);
        $query->execute();
        $data = $query->fetchAll();

        if($data) {
            for ($i=0; $i<count($data); $i++) {
                echo '
                  <tr>
                    <td>' . $data[$i]['id'] . '</td>
                    <td>' . $data[$i]['login'] . '
                    <details>
                        <summary>Modifier -></summary>
                        <input type="text" id="adminlogin' . $i . '" name="adminlogin' . $i . '" value="' . $data[$i]['login'] .'" required>
                    </details>
                    </td>
                    <td>' . $data[$i]['firstname'] . '
                    <details>
                        <summary>Modifier -></summary>
                        <input type="text" id="adminfirstname' . $i . '" name="adminfirstname' . $i . '" value="' . $data[$i]['firstname'] .'" required>
                    </details>
                    </td>
                    <td>' . $data[$i]['lastname'] . '
                    <details>
                        <summary>Modifier -></summary>
                        <input type="text" id="adminlastname' . $i . '" name="adminlastname' . $i . '" value="' . $data[$i]['lastname'] .'" required>
                    </details>
                    </td>
                    <td>' . $data[$i]['password'] . '
                    <details>
                        <summary>Modifier -></summary>
                        <input type="text" id="adminpassword' . $i . '" name="adminpassword' . $i . '" value="' . $data[$i]['password'] .'" required>
                        
                    </details>
                    </td>
                    <td>
                    
                        <input type="checkbox" id="deleteuser' . $i .'" name="deleteuser' . $i .'" value="Supprimer">
                    
                    </td>
                </tr>
                ';
            }
            
            
            
        }
    }
    public function updateAndDeleteInformation() {
        $cquery = $this->connexion->prepare('SELECT * FROM user');
        $cquery->execute();
        $cdata = $cquery->fetchAll();
        for ($y=0; $y<count($cdata); $y++) {
            if (isset($_POST['adminlogin' . $y]) && !empty($_POST['adminlogin' . $y]) 
            && isset($_POST['adminfirstname' . $y]) && !empty($_POST['adminfirstname' . $y])
            && isset($_POST['adminlastname' . $y]) && !empty($_POST['adminlastname' . $y]) 
            && isset($_POST['adminpassword' . $y]) && !empty($_POST['adminpassword' . $y])) {
                $goodid=$y+1;
                $mquery = $this->connexion->prepare('UPDATE user SET login = :login, firstname = :firstname, lastname = :lastname, password = :password WHERE id = :id');
                $mquery->bindValue(':login', $_POST['adminlogin' . $y],PDO::PARAM_STR);
                $mquery->bindValue(':firstname', $_POST['adminfirstname' . $y]);
                $mquery->bindValue(':lastname', $_POST['adminlastname' . $y]);
                $mquery->bindValue(':password', $_POST['adminpassword' . $y]);
                $mquery->bindValue(':id', $goodid);
                $mquery->execute();
            }
            if(isset($_POST['deleteuser' . $y])) {
                $goodidy=$y+1;
                $dquery = $this->connexion->prepare('DELETE FROM user WHERE id = :id');
                $dquery->bindValue(':id', $goodidy);
                $dquery->execute();
            }
        }
    }
}
$admin = new Admin();
$admin->updateAndDeleteInformation();
$admin->isnotAdmin();
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Assurance tourisqte</title>
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
                    <h1>Administration.</h1>
                    <h2>Listes des utilisateurs (! Ne modifiez pas les informations de admin /!\ cela peut créer des erreurs de sessions !) :</h2>
                    <form action="./admin.php" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID (non modifiable)</th>
                                    <th>Utilisateur</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Mot de passe</th>
                                    <th>Supprimer l'utilisateur ?</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $admin->showEveryone(); ?>
                            </tbody>
                        </table>
                        <button>Valider les modifcations</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>