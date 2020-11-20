<?php
session_start();



/*routine de validation des données*/
if(isset($_SESSION) && !empty($_SESSION)){
    header('location:connexion.php');
}

 elseif (isset($_POST['inscription'])) {
    function valid_data($data){
                $data = trim($data);/*enlève les espaces en début et fin de chaîne*/
                $data = stripslashes($data);/*enlève les slashs dans les textes*/
                $data = htmlspecialchars($data);/*enlève les balises html comme ""<>...*/
                return $data;
            }
    /*on récupère les valeurs login ,password, prenom, nom du formulaire et on y applique
     les filtres de la fonction valid_data*/
    $login = valid_data($_POST["login"]);
    $password = $_POST["password"];
    $prenom = valid_data($_POST['prenom']);
    $nom = valid_data($_POST['nom']); 

    

    $password = password_hash($password, PASSWORD_DEFAULT);/*Crypte le mot de passe*/
    $db=mysqli_connect("localhost","root","","moduleconnexion");
    /*on prépare une requête pour récupérer les données de l'utilisateur qui a rempli
     le formulaire, afin de vérifier que le login n'existe pas déja dans la table*/
    $read_utilisateur= "SELECT * FROM utilisateurs WHERE login='$login'";
    $requete = mysqli_query($db, $read_utilisateur);
    $result = mysqli_fetch_all($requete);

            if (!empty($result))
            {
                $error="Ce login existe déja !";
            }
            elseif ($_POST['password'] != $_POST['conf-password'])
            {
                $error="Les mots de passe ne sont pas identiques!";
            }
            elseif(empty($_POST['password']))
            {
                $error="tous les champs doivent être remplis!";
            }
            else
            {
                /*si le login est nouveau, on insert les données dans la base moduleconnexion,table utilisateurs*/
            $create="INSERT INTO utilisateurs (login, prenom, nom, password)
                VALUES ('$login','$prenom','$nom','$password')";
                $query = mysqli_query($db,$create);
                /* on attribue une valeur login au tableau session si la requéte a fonctionné*/
                if($query){$_SESSION['login']=$login; $_SESSION['nom']=$nom; $_SESSION['prenom']=$prenom;}
                header('Location:connexion.php');
            }
    mysqli_close($db);

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Accueil</title>
</head>
<body>
    <div class="container">
        <div class="page-header" >
        
            <div id="banner">
                <div class="row">
                    <div class="col-lg-12">
                    
                        <h1>Let's cook</h1>
                        <p class="h2">Partageons nos recettes</p>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                    
                    </a>
                </li>
                <?php  if(isset($_SESSION['login']) && !empty($_SESSION['login']))
                    {
                        echo '<li class="nav-item active align-right">
                        <span class="nav-link">Vous êtes connecté(e)</span>    
                        </li>';
                        echo '<li class="nav-item align-right">
                        <form action="connexion.php" method="post">                                            
                            <button type="submit" class="btn btn-info" name="session_fin">Déconnexion</button><br/>                        
                        </form>
                        </li>';
                    } else{
                        echo '<li class="nav-item active">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                        <span class="sr-only">(current)</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Inscription</a>
                    </li>';
                    }
                    ?>
                </ul>  
            </div>
        </nav>
        <main class="jumbotron">
            <div class="row">
                <div class="col-lg-6 col-sm-12"><br/>
                    <p class="h4">Remplissez notre formulaire d'inscription</p><br/>
                    <form action="inscription.php" method="post">
                    <fieldset>
                       <!-- envoyer un message d'erreur si login existe déja ou si password invalide-->
                        <?php if(!empty($error)){echo '<p class="h4 text-warning">'.$error.'</p>'; } ?>   
                        <div class="form-group">
                        <label for="login">Login</label>
                        <input type="txt" class="form-control" id="login"  name="login" placeholder="Entrer Login">
                        </div>
                         <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="txt" class="form-control" id="prenom"  name="prenom" placeholder="Entrer Prénom">
                        </div>
                         <div class="form-group">
                        <label for="Nom">Nom</label>
                        <input type="txt" class="form-control" id="nom"  name="nom" placeholder="Entrer Nom">
                        </div>
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                        <label for="conf-password">Confirmer Password</label>
                        <input type="password" class="form-control" id="conf-password" name="conf-password" placeholder="Confirmer Password">
                        </div>
                        <button type="submit" class="btn btn-success" name="inscription">Envoyer</button>
                    </fieldset>
                    </form>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <img class="img-small" src="assets/images/moules.jpg" alt="moules">
                </div>
                
            </div>
        </main>
        <footer id="footer">
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-lg-right"><a href="#top">Back to top</a></li>
              
              <li><a href="https://github.com/thomaspark/bootswatch">GitHub</a></li>
              
            </ul>
            <p>Bootstrap style made by <a href="https://thomaspark.co/">Thomas Park</a>.</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/master/LICENSE">MIT License</a>.</p>
            
          </div>
        </div>
      </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>