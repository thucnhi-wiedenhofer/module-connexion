<?php
var_dump($_POST)



<?php if(isset($_SESSION['login']) && $_SESSION['login']!="admin"){
    echo '<p class="h4"> Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].'.</p><br />';
    echo '<p class="h5">Pour vérifier ou modifier vos informations:</p>';
    echo '<form action="profil.php" method="post"><button type="submit" class="btn btn-primary btn-lg btn-block" name="modifier">Consulter</button></form>';
}
else{



    <?php 
    if(isset($_SESSION['login']) AND !empty($_SESSION['login']))
    {
        echo '<li class="nav-item active align-right">
        <span class="nav-link">Vous êtes connecté(e)</span>    
        </li>';
        echo '<li class="nav-item align-right">
        <form action="index.php" method="post">                                            
            <button type="submit" class="btn btn-info" name="session_fin">Déconnexion</button><br/>                        
        </form>
        </li>';
    }
    ?>  
    
    
    <?php
session_start();
if(isset($_POST['session_fin']))
{
    //enlève les variables de la session
    session_unset();
    //détruit la session
    session_destroy();
}

?>
?>