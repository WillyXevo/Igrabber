<?php

require_once("config.php");

?>
<div class="container container-story">
	<br>
	<!-- <img class="img-responsive" src="https://scontent-iad3-1.cdninstagram.com/v/t51.2885-15/e35/135783136_421303292401490_4426573880975717018_n.jpg?_nc_ht=scontent-iad3-1.cdninstagram.com&_nc_cat=102&_nc_ohc=-G2Fz3_HhGUAX-eVll0&tp=1&oh=22f8be41fd1e5e86cff79ac84efbb08e&oe=60201CC2">
	<br>
	<hr>
	<br>
	<video width="100%" controls="">
		<source type="video/mp4" src="https://scontent-iad3-1.cdninstagram.com/v/t50.2886-16/135846057_2821553274724084_4339474071160808773_n.mp4?_nc_ht=scontent-iad3-1.cdninstagram.com&_nc_cat=104&_nc_ohc=Jd5D7w9FWlYAX9Ww2Ns&oe=5FFAC960&oh=88b6491b5f3a3c21f53efa9eb3254c48">
	</video> -->

<?php

if(isset($_GET['sht'])){
	$ty = $_GET['sht'];
	$val = $_GET['va'];
	$api = $GLOBALS['api']."gp";
    $fgc = @file_get_contents("$api/$val");
	if($fgc === FALSE){
		echo "<p class='lead' style='color:#F00'>Error!</p>";
	}else{
		$json = json_decode($fgc,true);
	    if(!is_array($json)){
	        echo "<p class='lead' style='color:#F00'>url doesn't valid</p>";
	    }else{
	        foreach ($json as $k => $v) {
	            ttype($v);
	        }
	    }
		/*if($ty=="post"){
		       
		}else{
			$v = ["is_video"=>$ty, "url"=>urldecode($val)];
			ttype($v);
		}*/
	}
}



function ttype($v){
	if($v['is_video']=="true"){
    	echo gen_video($v['url']);
    }else{
    	echo gen_img($v['url']);
    }
}

function gen_video($lk){
	$lk = e_url($lk);
	$src = "video.php?url=".$lk;

	$ret = '<video width="100%" controls src="'.$src.'">';
	//$ret .= '<source type="video/mp4" >';
	$ret .= '</video>';
	return $ret;
}
function gen_img($src){
	$a = file_get_contents($src);
    $src =  base64_encode($a);
    //echo "<img class=\"img-responsive\" src=\"data:image/png;base64, $src\" >";
	$ret = '<img class="img-responsive" src="data:image/png;base64, '.$src.'" alt="image">';
	return $ret;
}

?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
        $("footer").hide();
    });
</script>