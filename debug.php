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
    <div class="col-lg-12 text-center v-center">
        <br><br><br><br>
        <form class="col-lg-12" id="frm" method="post" action="index.php?p=debug">
            <div class="input-group input-group-lg col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                <input type="text" name="url" id="url" class="center-block form-control input-lg" title="Enter url." placeholder="Enter url">
                <span class="input-group-btn">
                    <button id="btnproses" class="btn btn-lg btn-primary" type="submit">OK</button>
                </span>
            </div>
        </form>
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
    $manage = json_decode(str_replace(";", "", $matches[1]));
    echo '<pre>';
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
    echo htmlentities($data);
    /*if(empty($matches)){
        echo "<p class='lead' style='color:#F00'>Link tidak valid</p>";
        return;
    }
    $entry_data = $manage->entry_data;
    
    $type = $entry_data->PostPage[0]->graphql->shortcode_media->__typename;

    return $type($entry_data);*/
}


?>