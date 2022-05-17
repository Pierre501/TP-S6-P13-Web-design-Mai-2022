<?php 
include("../model/Facteurs.php");
include("../model/ViewConsequence.php");

if(!empty($_POST['facteurs']) && !empty($_POST['consequence']) && !empty($_FILES['file']) && !empty($_POST['details']))
{
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    $extensions[0] = "jpg";
    $extensions[1] = "png";
    $extensions[2] = "jpeg";
    $extensions[3] = "gif";
    $maxSize = 1000000;
    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0)
    {
        $uniqueName = uniqid('', true);
        $file = $uniqueName.".".$extension;
        move_uploaded_file($tmpName, './../../images/'.$file);
        $facteurs = new Facteurs();
        $view = new ViewConsequence();
        $url = $facteurs->formatUrl($_POST['facteurs']);
        $facteurs->insertionFacteurs($_POST['facteurs'], $url, $file, $_POST['consequence']);
        $view->insertionDetailsConsequences($_POST['consequence'], $_POST['details']);
        header('Location: admin.hml');
    }
    else
    {
        header('Location: formulaire-incomplete.html');
    }
}
else
{
    header('Location: formulaire-incomplete.html');
}

?>