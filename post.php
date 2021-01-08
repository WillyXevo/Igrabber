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
function get_post(o){$(".prog-box").show();var e=$(".loading-progress").progressTimer({timeLimit:240,onFinish:function(){$(".loading-progress").hide()}});$.ajax({url:"func.php?url="+o}).error(function(){e.progressTimer("error",{errorText:"ERROR!",onFinish:function(){alert("There was an error processing your information!")}})}).done(function(o){$(".hasil_gen").html(o),$(".hasil_gen").append("<p class='lead'><a href='#' onclick='location.reload();return false;''>Donwload Again</a></p>"),e.progressTimer("complete"),$("footer").hide()})}function modal_view(o){var e=$(o).attr("data-href"),r=$(o).attr("data-type");console.log(e),console.log(r),$("#modalView").modal("show");var i="";"true"==r?(i='<video controls width="100%">',i+='<source type="video/mp4" src="'+e+'">',i+="</video>"):i='<img class="img-responsive" src="'+e+'" alt="preview">',$(".modal-preview").html(i)}$(document).ready(function(){$(".prog-box").hide(),$("#btnproses").click(function(){get_post($("#url").val())}),$("#frm").submit(function(o){o.preEventDafault()}),$("#modalView").on("hidden.bs.modal",function(o){$(".modal-preview").html("")})});
</script>