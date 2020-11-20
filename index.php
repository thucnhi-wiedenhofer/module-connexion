<?php
session_start();
//déconnexion
if(isset($_POST['session_fin']))
{
    //enlève les variables de la session
    session_unset();
    //détruit la session
    session_destroy();
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <?php  if(isset($_SESSION['login'])) //message de connexion dans la navbar
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
                        echo '<li class="nav-item">
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
                <div class="col-lg-6 col-sm-12">
                    <img class="img-small" src="assets/images/bol.jpg" alt="bol">
                </div>
                <div class="col-lg-6 col-sm-12"><br/>
                <?php  if(isset($_SESSION['login']) && $_SESSION['login']!="admin")//page de connexion en tant qu'utilisateur
                    {
                        echo '<p class="h5">Vous pouvez dès à présent partager vos recettes et consulter celles des autres membres.</p><br />';
                        echo '<p class="h5">Pour vérifier ou modifier vos informations:</p>';
                        echo '<form action="profil.php" method="post"><button type="submit" class="btn btn-primary btn-lg btn-block" name="modifier">Consulter</button></form>';
                        //page de connexion en tant qu'administrateur:
                    }elseif(isset($_SESSION['login']) && $_SESSION['login']=="admin"){
                        echo '<p class="h5">Pour vérifier ou modifier les informations des adhérents:</p>';
                        echo '<a href="admin.php"><button type="submit" class="btn btn-primary btn-lg btn-block">Administrer Membres</button></a>';
                    }
                    
                    //page avant connexion ou inscription:
                    else{
                        echo ' <p class="h5">Vous n\'avez pas d\'idée pour ce soir? <br/>Consultez et échangez vos recettes entre membres.<br/>
                        Pour accéder à notre espace abonné, veuillez-vous connecter.</p><br/>
                       <a href="connexion.php"><button type="button" class="btn btn-success btn-lg">Connexion</button><br/><br/></a>
                       <p class="h4">ou</p><br/>
                       <a href="inscription.php"><button type="button" class="btn btn-primary btn-lg btn-block">Inscrivez-vous</button></a>';
                    }

                    ?>
                    
                </div>
            </div>
        </main>
        <footer id="footer">
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="float-lg-right"><a href="#top">Back to top</a></li>
              
              <li><a href="https://github.com/thucnhi-wiedenhofer">GitHub</a></li>
              
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