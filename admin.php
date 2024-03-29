<?php

if(isset($_POST['session_fin']))
{
    //enlève les variables de la session
    session_unset();
    //détruit la session
    session_destroy();
}



session_start();

/*routine de validation des données*/
        
            if($_SESSION['login']=="admin" && $_SESSION['password']=="admin"){
                $db=mysqli_connect("localhost","root","","moduleconnexion");
                $requete= "SELECT * FROM utilisateurs";
                $query = mysqli_query($db, $requete);
                mysqli_close($db);
                $_SESSION['nom']="admin";
                $_SESSION['prenom']="admin";

            }
            else {
            $error_adm = "Vous n'avez pas accés à cet Espace administration";
            header('location:connexion.php');
            }                
           
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Administration</title>
</head>
<body>
    <div class="container">
        <header class="page-header" >
        
            <div id="banner">
                <div class="row">
                    <div class="col-lg-12">
                    
                        <h1>Let's cook</h1>
                        <p class="h2">Partageons nos recettes</p>
                    </div>
                    
                </div>
            </div>
            
        </header>
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
                <?php  if(isset($_SESSION['login']) && $_SESSION['login']=="admin")
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
                <section class="col-lg-12"><br/>
                    <table class="table table-hover">
                    <thead>
                        <tr class="table-active">
                        <th scope="col">ID</th>
                        <th scope="col">Login</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Password</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        echo "<tr>";//affiche en boucle les données de la table
                        while (($resultats = mysqli_fetch_assoc($query)) != null)
                        {
                            echo "<td>".$resultats['id']."</td>";
                            echo "<td>".$resultats['login']."</td>";
                            echo "<td>".$resultats['prenom']."</td>";
                            echo "<td>".$resultats['nom']."</td>";
                            echo "<td>".$resultats['password']."</td>";
                           
                        echo "</tr>";
                        }
                    ?>  
                    </tbody>
                    </table>
                    </section>
                
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