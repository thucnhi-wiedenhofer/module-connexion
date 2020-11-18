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
                <form action="profil.php" method="post">
                    <fieldset>   
                        <div class="form-group">
                        <label for="login">Login</label>
                        <input type="txt" class="form-control" id="login"  name="login" placeholder="Entrer Login">
                        </div>
                                               
                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        
                        <button type="submit" class="btn btn-info">Connexion</button><br/>
                        
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
                <form action="admin.php" method="post">
                    
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
                            
                            <button type="submit" class="btn btn-info">Connexion</button>
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