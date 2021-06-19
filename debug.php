<div class="row">
    <div class="col-lg-12">
    <?php
        //include "func.php";
        //$link = "https://www.instagram.com/p/CPjyVvSjqPw/?utm_medium=copy_link";
        //$link = "https://www.instagram.com/p/CPjyVvSjqPw/";
        $link = "https://www.instagram.com/p/CPqDjflD-43/";
        /*echo "$link<br>";
        $getig = fromig($link);
        echo $getig;*/
    ?>
    </div>
    <div class="col-lg-12 v-center">
        <br><br><br><br>
        <!-- <form class="col-lg-12" id="frm" method="post" action="index.php?p=debug">
            <div class="input-group input-group-lg col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                <input type="text" name="url" id="url" class="center-block form-control input-lg" title="Enter url." placeholder="Enter url">
                <span class="input-group-btn">
                    <button id="btnproses" class="btn btn-lg btn-primary" type="submit">OK</button>
                </span>
            </div>
        </form> -->
        <pre>
        <?php
        echo "<br>";
        /*$list = [
                "https://www.instagram.com/p/CPqDjflD-43/",
                "https://www.instagram.com/p/CPogao4rFUC/",
                "https://www.instagram.com/p/CPcsgYDD0Ll/",
                "https://www.instagram.com/p/CPda2UVlLtb/",
                "https://www.instagram.com/p/CPqBNAzj7MT/",
                "https://www.instagram.com/p/CPnxHmHDBRc/",
                "https://www.instagram.com/p/CPiw6-IlQNy/"
                ];
        print_r($list);
        foreach ($list as $k => $v) {
            fromig($v);
            echo "<br>";
        }*/
        $ls = "https://www.instagram.com/p/CPkvl8CjzRk/";
        //fromig($ls);
        $a = file_get_contents("https://instagram.fzty3-2.fna.fbcdn.net/v/t51.2885-15/e35/194344028_158543276178755_1628573454409683897_n.jpg?se=7&tp=1&_nc_ht=instagram.fzty3-2.fna.fbcdn.net&_nc_cat=111&_nc_ohc=X7zQM74CxBUAX_ju1IT&edm=AP_V10EBAAAA&ccb=7-4&oh=7322cf7d6b3825841aa2c2b100af8744&oe=60D597C1&_nc_sid=4f375e&ig_cache_key=MjU4Nzg5NjU2OTEwNjc4Nzg5NQ%3D%3D.2-ccb7-4");
        
        $src =  base64_encode($a);
        echo $src;    
        ?>
        </pre>

        <img src="data:image/png;base64, <?= $src; ?>" >
    </div>
    <div class="col-lg-12 v-center prog-box">
        <div class="hasil_gen">
        <?php
            if(isset($_POST['url'])){
                echo $_POST['url'];
                fromig($_POST['url']);
            }
        ?>
        </div>
    </div>
    
</div> <!-- /row -->


<?php

function fromig($url=''){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, null);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Upgrade-Insecure-Requests: 1",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
        
    ));

    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    $error = curl_error($ch);

    curl_close($ch);
    $regexp='/\<script type\="text\/javascript\">window\.\_sharedData \= (.*?)<\/script\>/s';
    preg_match($regexp, $data, $matches);
    $manage = json_decode(str_replace(";", "", $matches[1]), true);
    /*echo '<pre>';
    echo 'INFO<br>';
    print_r($info);
    echo '<hr>';
    echo 'ERROR<br>';
    print_r($error);
    echo '<hr>';
    print_r($matches);
    echo '<hr>';
    print_r($manage);
    echo '</pre>';
    echo htmlentities($data);*/
    /*if(empty($matches)){
        echo "<p class='lead' style='color:#F00'>Link tidak valid</p>";
        return;
    }
    $entry_data = $manage->entry_data;
    
    $type = $entry_data->PostPage[0]->graphql->shortcode_media->__typename;

    return $type($entry_data);*/
    //print_r($manage);
    //echo json_encode($manage)."<br>";
    $ds = $manage["entry_data"]["PostPage"][0]["graphql"]["shortcode_media"]["edge_sidecar_to_children"]["edges"];
    //print_r($ds);
    foreach ($ds as $k => $v) {
        //$a = $v["node"]["PostPage"][0]["graphql"]["shortcode_media"]["display_resources"];
        $a = $v["node"]["display_resources"];

        print_r($a[sizeof($a)-1]["src"]);
        echo "<br>";
    }
    /*$ds = $manage["entry_data"]["PostPage"][0]["graphql"]["shortcode_media"]["display_resources"];
    print_r($ds[sizeof($ds)-1]["src"]);*/
}


?>