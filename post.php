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

<script type="text/javascript">
function setCookie(o,e,t){var n=new Date;n.setTime(n.getTime()+24*t*60*60*1e3);var i="expires="+n.toUTCString();document.cookie=o+"="+e+";"+i+";path=/"}function getCookie(o){for(var e=o+"=",t=document.cookie.split(";"),n=0;n<t.length;n++){for(var i=t[n];" "==i.charAt(0);)i=i.substring(1);if(0==i.indexOf(e))return i.substring(e.length,i.length)}return""}function checkCookie(){var o=getCookie("uname"),e=getCookie("pass");""!=o&&""!=e?(console.log(o),console.log(e)):console.log("not login")}$(document).ready(function(){$(".btn-login").click(function(){var o=$("#log_username").val(),e=$("#log_password").val();setCookie("uname",o,1),setCookie("pass",e,1)}),setCookie("test","ini",1),console.log(getCookie("test")),checkCookie()});
</script>