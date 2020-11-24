<?php
session_start();

function valid_data($data){  //fonction pour éviter l'injection de code malveillant
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['modifier']) && isset($_SESSION['id'])) { //un adhérent qui s'est connecté veut modifier ses données
    
    $id=$_SESSION['id'];
    $db=mysqli_connect("localhost","root","","moduleconnexion");    
    $read_utilisateur= "SELECT * FROM utilisateurs WHERE id='$id'";
    $requete = mysqli_query($db, $read_utilisateur);
    $result = mysqli_fetch_array($requete);
    mysqli_close($db);

            if (empty($result)) //la requête n'a pas aboutie
            {
                $error="Il y a une erreur de lecture de vos données!";
                 
            }
            else //succés on conserve dans des variables les infos de l'adhérent pour remplir le formulaire
            {
            $login = $result['login'];
            $prenom = $result['prenom'];
            $nom = $result['nom'];
            $password = $result['password'];
            $_POST = array(); 
            }                         
}

elseif (isset($_POST['update']) && $_SESSION['id']==$_POST['id'] ) { //l'adhérent a modifié ses données, on conserve en variables ces nouvelles données
    
    $id= $_SESSION['id'];
    $login = valid_data($_POST['login']);
    $prenom = valid_data($_POST['prenom']);
    $nom = valid_data($_POST['nom']);
    $new_Password = $_POST['password'];
    $new_Password = password_hash($new_Password, PASSWORD_DEFAULT);

    if ($_POST['password'] != $_POST['conf-password']){
                $error="Les mots de passe ne sont pas identiques!"; //erreur dans le formulaire
            
            }
            else
            {
                $db=mysqli_connect("localhost","root","","moduleconnexion");
                // on update les données  de l'utilisateur dans la base moduleconnexion,table utilisateurs
                $update= "UPDATE utilisateurs SET  login = '$login', prenom = '$prenom', nom = '$nom', password = '$new_Password'
                WHERE id= '".$id."' ";
                $query = mysqli_query($db,$update);
                /* on attribue les nouvelles valeurs au tableau session si la requéte a fonctionné*/
               if($query && isset($_POST['update']))
               {$_SESSION['login']=$login;
                $_SESSION['nom']=$nom;
                $_SESSION['prenom']=$prenom;
                $_SESSION['update']="Ok";
                header('Location:connexion.php');
                }
                
            }
   
  
}else{

   $error="tous les champs doivent être remplis";
   header('Location:connexion.php');
}
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
                <section class="col-lg-6 col-sm-12"><br/>
                    <p class="h4">Vérifier ou modifier votre profil </p><br/>
                   <?php if(!empty($error)){echo '<p class="h4 text-warning">'.$error.'</p>'; } //affiche message d'erreur généré dans le script profil.php
                   ?> 
                    <form action="profil.php" method="post">
                    <fieldset>   
                        <div class="form-group">
                            
                        <label for="login">Login</label>
                        <input type="txt" class="form-control" id="login"  name="login"  value="<?php echo $login; ?>">
                        </div>
                         <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="txt" class="form-control" id="prenom"  name="prenom" value="<?php echo $prenom; ?>">
                        </div>
                         <div class="form-group">
                        <label for="Nom">Nom</label>
                        <input type="txt" class="form-control" id="nom"  name="nom" value="<?php echo $nom; ?>">
                        </div>
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre password ou un nouveau." required>
                        </div>
                        <div class="form-group">
                        <label for="conf-password">Confirmer Password</label>
                        <input type="password" class="form-control" id="conf-password" name="conf-password" placeholder="Doit être identique" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo (int)$id;// conserve la valeur id dans un champs caché du formulaire
                        ?>">
                        <button type="submit" class="btn btn-success" name="update">Modifier</button>
                    </fieldset>
                    </form>
                </section>
                
                <section class="col-lg-6 col-sm-12">
                    <img class="img-small" src="assets/images/moules.jpg" alt="moules">
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