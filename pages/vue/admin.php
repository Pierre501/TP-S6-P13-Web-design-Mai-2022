<?php 
include("../model/Facteurs.php");
include("../model/ViewConsequence.php");
$facteurs = new Facteurs();
$view = new ViewConsequence();
$tabFacteurs = $facteurs->getAllFacteurs();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Administrateur</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/metisMenu.min.css" rel="stylesheet">
        <link href="css/timeline.css" rel="stylesheet">
        <link href="css/startmin.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <link href="css/colors.css" rel="stylesheet">
        <link href="css/version/tech.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Administrateur</a>
                </div>
                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>Utilisateur</a></li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Paramètre</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-default sidebar" role="navigation" style="margin-top: 60px;">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Recherche...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                            </li>
                            <li>
                                <a href="admin.html" class="active"><i class="fa fa-dashboard fa-fw"></i>Accueil</a>
                            </li>
                            <li>
                                <a href="ajouter.html"><i class="fa fa-plus-square"></i>Ajouter</a>
                            </li>
                            <li>
                                <a href="traitement2.html"><i class="fa fa-sign-out"></i>Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Liste des contenues</h1>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                                <div class="blog-top clearfix">
                                </div><!-- end blog-top -->
                                    <div class="blog-list clearfix">
                                    <?php foreach($tabFacteurs as $facteurs) { ?>
                                        <div class="blog-box row">
                                            <div class="col-md-4">
                                                <div class="post-media">
                                                    <a href="tech-single.html" title="">
                                                        <img src="images/<?php echo $facteurs->getImage(); ?>" alt="" class="img-fluid">
                                                        <div class="hovereffect"></div>
                                                    </a>
                                                </div><!-- end media -->
                                            </div><!-- end col -->

                                            <div class="blog-meta big-meta col-md-8">
                                                <h4><?php echo $facteurs->getFacteurs(); ?></h4>
                                                <form action="modifier-<?php echo $facteurs->getUrl(); ?>" method="post">
                                                    <p><input type="hidden" name="id" value="<?php echo $facteurs->getIdFacteurs(); ?>" /></p>
                                                    <p><small class="firstsmall"><i class="fa fa-edit"><input type="submit" class="bg-orange" value="MODIFIER" /></i></small></p>
                                                </form>
                                                <p><small class="firstsmall"><a class="bg-orange" href="supprimer-<?php echo $facteurs->getUrl(); ?>" title=""><i class="fa fa-trash-o">Supprimer</a></i></small></p>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                        <hr class="invis">
                                    <?php } ?>
                                </div><!-- end blog-list -->
                            </div><!-- end page-wrapper --> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/metisMenu.min.js"></script>
        <script src="js/raphael.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/morris-data.js"></script>
        <script src="js/startmin.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/tether.min.js"></script>
    </body>
</html>
