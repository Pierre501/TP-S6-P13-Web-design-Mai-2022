<?php
include("../model/Facteurs.php");
include("../model/ViewConsequence.php");
session_start();

if(isset($_GET['id']))
{
    $rechauff = new Facteurs();
    $rechauffement = $rechauff->getSimpleFacteurs($_GET['id']);
    $split = explode("/",$_SERVER['REQUEST_URI']);
    $url = end($split);
    $condition = explode("-", $url);
    if(in_array("modifier", $condition) || in_array("supprimer", $condition) || in_array("modification", $condition))
    {
        if($url == "supprimer-".$rechauffement->getUrl())
        {
            $rechauff->suppressionFacteurs($_GET['id']);
            header('Location: admin.html');
        }
        else if($url == "modifier-".$rechauffement->getUrl())
        {
            $_SESSION['id'] = $_POST['id'];
            header('Location: modifier.html');
        }
        else if($url == "modification-".$rechauffement->getUrl())
        {
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
                    $facteur = new Facteurs();
                    $view = new ViewConsequence();
                    $facteurs = $facteur->getSimpleFacteursByName($_POST['facteurs']);
                    $url = "";
                    if($_POST['facteurs'] == $facteurs->getFacteurs())
                    {
                        $url = $facteurs->getUrl();
                    }
                    else
                    {
                        $url = $facteur->formatUrl($_POST['facteurs']);
                    }
                    $facteurs->modificationFacteurs($facteurs->getIdFacteurs(), $facteurs->getFacteurs(), $url, $file,$_POST['consequence']);
                    $detailsConsequence = $view->getSimpleViewConsequence($facteurs->getConsequence());
                    $view->modificationDetailsConsequence($detailsConsequence[0]->getIdDetailsConsequence(), $facteurs->getConsequence(), $_POST['details']);
                    header('Location: admin.html');
                }
            }
            else
            {
                header('Location: erreur.html');
            }
        }
        else
        {
            header('Location: erreur.html');
        }
    }
    else
    {
        if($url != $rechauffement->getUrl())
        {
            header('Location: erreur.html');
        }
        $consequence = new ViewConsequence();
        $tabConsequences = $consequence->getSimpleViewConsequence($rechauffement->getConsequence());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $rechauffement->getFacteurs(); ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/colors.css" rel="stylesheet">
    <link href="css/version/tech.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="accueil.html">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Images</a>
                            </li>                   
                            <li class="nav-item">
                                <a class="nav-link" href="#">Videos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Infos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav mr-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-tree"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->
        <section class="section single-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="single-post-media" style="width: 1100px; height: 500px;">
                                <img src="images/<?php echo $rechauffement->getImage(); ?>" alt="" >
                            </div>
                            <div class="blog-title-area text-center">
                                <h3><?php echo $rechauffement->getFacteurs(); ?></h3>
                            </div>
                            <div class="blog-content"> 
                                <div>
                                    <h3><?php echo $tabConsequences[0]->getTypeConsequence(); ?></h3>
                                </div> 
                                <?php foreach($tabConsequences as $consequences) { ?>
                                    <div>
                                        <p><?php echo $consequences->getDetailsConsequence(); ?></p>
                                    </div><!-- end pp -->
                                <?php } ?>
                            </div><!-- end content -->
                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Reply</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper">
                                            <input type="text" class="form-control" placeholder="Your name">
                                            <input type="text" class="form-control" placeholder="Email address">
                                            <input type="text" class="form-control" placeholder="Website">
                                            <textarea class="form-control" placeholder="Your comment"></textarea>
                                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="widget">
                            <div class="footer-text text-left">
                            <h2 class="widget-title">Infos climatique</h2>
                                <p>La météo s’en trouve perturbée, avec une augmentation des phénomènes météorologiques extrêmes, des changements des modèles météorologiques habituels.</p>
                                <div class="social">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                </div>
                                <hr class="invis">
                                <div class="newsletter-widget text-left">
                                    <form class="form-inline">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                    </form>
                                </div><!-- end newsletter -->
                            </div><!-- end footer-text -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Categories populaire</h2>
                            <div class="link-widget">
                                <ul>
                                    <li><a href="#">Marketing <span>(21)</span></a></li>
                                    <li><a href="#">SEO Service <span>(15)</span></a></li>
                                    <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                    <li><a href="#">Make Money <span>(22)</span></a></li>
                                    <li><a href="#">Blogging <span>(66)</span></a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Copyrights</h2>
                            <div class="link-widget">
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Advertising</a></li>
                                    <li><a href="#">Write for us</a></li>
                                    <li><a href="#">Trademark</a></li>
                                    <li><a href="#">License & Help</a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="copyright">&copy; Tech Blog. Design: <a href="http://html.design">HTML Design</a>.</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>