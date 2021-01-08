<?php
    require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#C80087">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#C80087">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#C80087">
    <meta name="description" content="Instagram Photo, Video, and IGTV Downloader. Simple way to Download Instagram Photos to your PC, Mac, Phone.">
    <meta name="keywords" content="Instagram Downloader, Download Instagram Photos, download Instagram pictures">
    <title>Igrabber</title>
    <link rel="shortcut icon" href="assets/img/icons.png" type="image/x-icon"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css?<?= time(); ?>">
    
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
    <div class="ajax_loading">
        <img src="assets/img/loading_world.svg" alt="loading">
    </div>
    <div class="main-header">
        <div class="container">
            <div class="sub-main-header">
                <img src="assets/img/logo.png" alt="logo" >
                <h2>Igrabber</h2>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Brand</a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?= !isset($_GET['p'])?'class="active"':''; ?> ><a href="index.php">Post <span class="sr-only">(current)</span></a></li>
                    <li <?= isset($_GET['p']) && $_GET['p']=='story'?'class="active"':''; ?> ><a href="index.php?p=story">Story</a></li>
                    <li <?= isset($_GET['p']) && $_GET['p']=='highlight'?'class="active"':''; ?> ><a href="index.php?p=highlight">Highlight</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    
    <div class="container-fluid">
    <?php
        if(isset($_GET['p'])){
            if($_GET['p']=='story'){
                include 'story.php';
            }else if($_GET['p']=='highlight'){
                include 'highlight.php';
            }
        }else if(isset($_GET['sht'])){
            include 'view.php';
        }else{
            include 'post.php';
        }
    ?>
    </div>
    
    <footer>
        <div class="container">
            Igrabber | powered by <a href="http://heroku.com/" target="blank">heroku</a>
        </div>
    </footer>
    <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Preview</h4>
                </div>
                <div class="modal-body modal-preview">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-copy-link">Copy Share Link</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.progressTimer.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js?<?= time(); ?>"></script>
    <script type="text/javascript">
       
    </script>
</body>
</html>