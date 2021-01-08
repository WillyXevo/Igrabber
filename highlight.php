<div class="container container-story">
    
    <?php
        /*echo e_url("suryagg12");
        echo "<br>";
        echo e_url("apa aja1996");*/
    ?>
    <br>
    <div class="alert alert-success alet_login alert-dis" style="display: none;">
        <h4><i class="fa fa-thumbs-up" aria-hidden="true"></i> Your'e Logged in!</h4>
        you logged in as 
        <strong id="notif_user"></strong><br>
        <a href="" onclick="return logout()">Logout</a>
    </div>
    <br>
    <form id="frm">
        <div class="alert alert-warning">
            <h4><i class="fa fa-warning" aria-hidden="true"></i> Attention!</h4>
            To use this feauters, you must logged in (input your instagram's username and password bellow).
            <strong>
            Don't worry, we won't save your login data,    
            </strong>
            it's only used for the system to work.
            if you are not willing please use other applications.
        </div>
        <div class="bg-info p-warning">
            <p>
                Get available highlight from users whose account username are given. 
                Does not mark stories as seen. 
                To use this, one needs to be logged in
            </p>
        </div>
        <fieldset>
            <legend>Login:</legend>
            <div class="form-group">
                <label for="log_username">Username</label>
                <input type="text" class="form-control" name="log_username" id="log_username" placeholder="Username" required >
            </div>
            <div class="form-group">
                <label for="log_password">Password</label>
                <input type="password" class="form-control" name="log_password" id="log_password" placeholder="Password" required >
            </div>
            <button type="button" class="btn btn-success btn-login">Login</button>
        </fieldset>
    </form>
    <div class="row row_story" style="display: none;" >
        <div class="col-lg-12 text-center v-center">
            <br><br><br><br>
            <form class="col-lg-12" id="frm2">
                <div class="input-group input-group-lg col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                    <input type="text" id="url" class="center-block form-control input-lg" title="Enter url." placeholder="Enter Instagram porfile username">
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
</div>

<script type="text/javascript">
function setCookie(o,e,n){var i=new Date;i.setTime(i.getTime()+24*n*60*60*1e3);var r="expires="+i.toUTCString();document.cookie=o+"="+e+";"+r+";path=/"}function getCookie(o){for(var e=o+"=",n=document.cookie.split(";"),i=0;i<n.length;i++){for(var r=n[i];" "==r.charAt(0);)r=r.substring(1);if(0==r.indexOf(e))return r.substring(e.length,r.length)}return""}function checkCookie(){var o=getCookie("uname"),e=getCookie("pass");""!=o&&""!=e?($("#frm").hide(),$(".alet_login").show(),$(".row_story").show(),$("#notif_user").text(o)):console.log("not login")}function logout(){return setCookie("uname","",-100),setCookie("pass","",-100),location.reload(),!1}function get_post(o){$(".prog-box").show();var e=$(".loading-progress").progressTimer({timeLimit:240,onFinish:function(){$(".loading-progress").hide()}});$.ajax({url:"func.php?gh="+o}).error(function(){e.progressTimer("error",{errorText:"ERROR!",onFinish:function(){alert("There was an error processing your information!")}})}).done(function(o){$(".hasil_gen").html(o),$(".hasil_gen").append("<p class='lead'><a href='#' onclick='location.reload();return false;''>Donwload Again</a></p>"),e.progressTimer("complete")})}$(document).ready(function(){$("footer").hide(),$(".btn-login").click(function(){var o=$("#log_username").val(),e=$("#log_password").val(),n=$("#frm").serialize();$.ajax({type:"POST",url:"login.php",data:n,beforeSend:function(){$(".ajax_loading").show()},success:function(n){console.log("respon : "+n),$(".ajax_loading").hide(),"false"!=n&&""!=n?(setCookie("uname",o,1),setCookie("pass",e,1),location.reload()):alert("Failed to login!")},error:function(){$(".ajax_loading").hide(),alert("ERROR")}})}),checkCookie(),$(".prog-box").hide(),$("#btnproses").click(function(){get_post($("#url").val())}),$("#frm").submit(function(o){o.preEventDafault()}),$("#modalView").on("hidden.bs.modal",function(o){$(".modal-preview").html("")})});
</script>