<?php
session_start();

if (isset($_POST['connexion']) && isset($_SESSION['id'])) {
    
    $id=$_SESSION['id'];
    
    function valid_data($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

    $db=mysqli_connect("localhost","root","","moduleconnexion");    
    $read_utilisateur_id= "SELECT * FROM utilisateurs WHERE id=$id";
    $requete = mysqli_query($db, $read_utilisateur_id);
    $result = mysqli_fetch_assoc($requete);

            if (!empty($result))
            {
                $error="Il y a une erreur de lecture de vos données!";
                 header('Location:connexion.php');
            }
            else
            {
            $login = $result['login'];
            $prenom = $result['prenom'];
            $nom = $result['nom'];
            $password = $result['password'];
            }
             mysqli_close($db);
           

            $create="INSERT INTO utilisateurs (login, prenom, nom, password)
                VALUES ('$login','$prenom','$nom','$password')";
                $query = mysqli_query($db,$create);
                header('Location:connexion.php');
            }
elseif (isset($_POST['modification']) && isset($_SESSION['id'])) {
   
            $login = valid_data($_POST["login"]);
            if( $verify = password_verify($plaintext_password, $hash); 
            $password = $_POST["password"];
            $prenom = valid_data($_POST['prenom']);
            $nom = valid_data($_POST['nom']);

    

    $password = password_hash($password, PASSWORD_DEFAULT);
    $db=mysqli_connect("localhost","root","","moduleconnexion");
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
            else
            {
            $create="INSERT INTO utilisateurs (login, prenom, nom, password)
                VALUES ('$login','$prenom','$nom','$password')";
                $query = mysqli_query($db,$create);
                header('Location:connexion.php');
            }
    mysqli_close($db);

}
}
   

}
$password = password_hash($password, PASSWORD_DEFAULT);
$login = valid_data($_POST["login"]);
    $password = $_POST["password"];
    $prenom = valid_data($_POST['prenom']);
    $nom = valid_data($_POST['nom']);

$db=mysqli_connect("localhost","root","","moduleconnexion");


$update="UPDATE utilisateurs SET login = $newLogin, prenom = $newPrenom, nom = $newNom, password = $newPassword
 WHERE id= $id";

$read= "SELECT * FROM utilisateurs WHERE id=$id";

$delete= "DELETE FROM utitlisateurs WHERE id=$id";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profil</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inscription.php">Inscription</a>
                </li>
                </ul>  
            </div>
        </nav>
        <main class="jumbotron">
            <div class="row">
                <div class="col-lg-6 col-sm-12"><br/>
                    <p class="h4">Vérifier ou modifier votre profil </p><br/>
                    <form action="profil.php" method="post">
                    <fieldset>   
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
                        <button type="submit" class="btn btn-success">Modifier</button>
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