<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");
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
    <link rel="stylesheet" href="assets/css/style.css">
    
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-main">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img src="assets/img/logo.png" alt="logo" >
                <h2>Igrabber</h2>
            </div>
        </div><!-- /.container-fluid -->
    </nav>

    
    <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 text-center v-center">
                <br><br><br><br>
                <form class="col-lg-12" id="frm">
                    <div class="input-group input-group-lg col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                        <input type="text" id="url" class="center-block form-control input-lg" title="Enter url." placeholder="Enter url">
                        <span class="input-group-btn">
                            <button id="btnproses" class="btn btn-lg btn-primary" type="button">OK</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-lg-12 text-center v-center prog-box">
                <br><br>
                <div class="progresbox" style="width:50%;margin:0 auto;">
                    <div class="loading-progress"></div>
                </div>
            </div>
            <div class="col-lg-12 v-center prog-box">
                <div class="hasil_gen"></div>
            </div>
            
        </div> <!-- /row -->
    </div> <!-- /container full -->
    
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.progressTimer.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".prog-box").hide();

            $("#btnproses").click(function(){
                var url = $("#url").val();
                get_post(url);
            });

            $("#frm").submit(function(e){
                e.preEventDafault();
            });
            $('#modalView').on('hidden.bs.modal', function (e) {
                $(".modal-preview").html("");
            });
            //$('#modalView').modal('show');
            //get_post("https://www.instagram.com/p/CJgPb_8BZUY/?igshid=h2rn4jx1wb9l");
        });

        function get_post(url) {
            $(".prog-box").show();

            var progress = $(".loading-progress").progressTimer({
                timeLimit: 240,
                onFinish: function () {
                    //alert('completed!');
                    $(".loading-progress").hide();
                }
            });

            $.ajax({
                url:"func.php?url="+url
            }).error(function(){
                progress.progressTimer('error', {
                    errorText:'ERROR!',
                    onFinish:function(){
                            alert('There was an error processing your information!');
                    }
                });
            }).done(function(result){
                //console.log(result);
                $(".hasil_gen").html(result);
                $(".hasil_gen").append("<p class='lead'><a href='#' onclick='location.reload();return false;''>Donwload Again</a></p>");
                progress.progressTimer('complete');
                $("footer").hide();
            });
        }

        function modal_view(ini) {
            var src = $(ini).attr("data-href");
            var type = $(ini).attr("data-type");
            console.log(src);
            console.log(type);
            $('#modalView').modal('show');
            var cont = "";
            if(type){
                cont = '<video controls width="100%">';
                    cont += '<source type="video/mp4" src="'+src+'">'; 
                cont += '</video>';
            }else{
                cont = '<img class="img-responsive" src="'+src+'" alt="preview">';
            }
            $(".modal-preview").html(cont);
        }
    </script>
</body>
</html>