<?php 
include('../model/Administrateur.php');
session_start();

if(!empty($_POST['username']) && !empty($_POST['mdp']))
{
    $admin = new Administrateur();
    $condition = $admin->verifierConnexion($_POST['username'], $_POST['mdp']);
    if($condition == true)
    {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['mdp'] = sha1($_POST['mdp']);
        header('Location: admin.html');
    }
    else
    {
        header('Location: login-erreur.html');
    }
}
else
{
    header('Location: login-erreur.html');
}

?>