<?php
session_start();


/*routine de validation des données*/


 if (isset($_POST['connexion'])) {
    function valid_data($data){
                $data = trim($data);/*enlève les espaces en début et fin de chaîne*/
                $data = stripslashes($data);/*enlève les slashs dans les textes*/
                $data = htmlspecialchars($data);/*enlève les balises html comme ""<>...*/
                return $data;
            }
    /*on récupère les valeurs login ,password du formulaire et on y applique
     les filtres de la fonction valid_data*/
    $login = valid_data($_POST["login"]);
    $password = $_POST["password"];
        

      $db=mysqli_connect("localhost","root","","moduleconnexion");
    /*on prépare une requête pour vérifier les données de l'utilisateur */
    $read_utilisateur= "SELECT * FROM utilisateurs WHERE login='$login'";
    $requete = mysqli_query($db, $read_utilisateur);
    $result = mysqli_fetch_all($requete);
    
            if (empty($result))
            {
                $error="Ce login n'existe pas!";
            }
            elseif (password_verify($password, $result[0][4]))//vérification de password
                { 
                    $_SESSION['login']=$result[0][1];
                    $_SESSION['nom']=$result[0][3];
                    $_SESSION['prenom']=$result[0][2];
                    header('Location:index.php');
                } 
            else 
                {
                    $error='Le mot de passe est invalide.';
                    mysqli_close($db);
                }
}
elseif(isset($_POST['administration'])) {
    function valid_data($data){
        $data = trim($data);/*enlève les espaces en début et fin de chaîne*/
        $data = stripslashes($data);/*enlève les slashs dans les textes*/
        $data = htmlspecialchars($data);/*enlève les balises html comme ""<>...*/
        return $data;
        }

        /*on récupère les valeurs login ,password du formulaire et on y applique
        les filtres de la fonction valid_data*/
        if(isset($_POST["login"]) && isset($_POST["password"])){
            $login = valid_data($_POST["login"]);
            $password = valid_data($_POST["password"]);
            if ($login==="admin" && $password==="admin"){
            header('Location:admin.php');
            }
            else {
            $error_adm = "Vous n'avez pas accés à cet Espace administration";
            }
    }

   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>connexion</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                    <span class="sr-only">(current)</span>
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
                <h2>Espace membres</h2>
                <form action="connexion.php" method="post">
                    <fieldset>

                    <?php if(!empty($error)){echo '<p class="h4 text-warning">'.$error.'</p>'; } ?>  

                        <div class="form-group">
                        <label for="login">Login</label>
                        <input type="txt" class="form-control" id="login"  name="login" placeholder="Entrer Login">
                        </div>
                                               
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="connexion">Connexion</button><br/>
                        
                    </fieldset>
                    </form>
                    
                </div>
                <div class="col-lg-6 col-sm-12">
                    <img class="img-small" src="assets/images/plat.jpg" alt="plat">
                </div>

            </div>
        </main>
        
            <article class="jumbotron">  
                <h2>Administration</h2> 
                 <?php if(isset($error_adm)){echo '<p class="h4 text-warning">'.$error_adm.'</p>'; } ?>
                <form action="connexion.php" method="post"> 
                    <fieldset>
                        <div class="row">    
                            <div class="form-group col-lg-4 col-sm-12">
                            <label for="login">Login</label>
                            <input type="txt" class="form-control" id="login"  name="login" placeholder="Entrer Login">
                            </div>
                                                
                            <div class="form-group col-lg-4 col-sm-12">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-lg-12 col-sm-12">
                            
                            <button type="submit" class="btn btn-info" name="administration">Connexion</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </article>        
                             
        
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