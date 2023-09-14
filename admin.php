<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
                    <li><a href="">Accueil</a></li>
                    <li><a href="">Profil</a></li>
                    <?php if($_SESSION): ?>
                    <li><a href="./index.php?url=disconnectController">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
        <main>
            <div class="container">
                <div id="users">
                    <h2>Listes des utilisateurs :</h2>
                    <button>Voir les utilisateurs</button>
                    <div id="jsonutilisateur"></div>
                </div>
            </div>
        </main>
    </body>
</html>