<?php


require('simplehtmldom/simple_html_dom.php');
require('table_generator.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: x-access-header, Authorization, Origin, X-Requested-With, Content-Type, Accept");


if(isset($_GET['url'])){
    echo getig($_GET['url']);
    //echo fromig($_GET['url']);
}

function getig($url=''){
    ///get shortcode
    $a = explode("/", $url);
    $shortcode = $a[4];
    //echo $shortcode;
    $api = "https://apigrabber.herokuapp.com/gp";
    $json = json_decode(file_get_contents("$api/$shortcode"),true);
    if(!is_array($json)){
        echo "<p class='lead' style='color:#F00'>Link tidak valid</p>";
        return;
    }else{
        $tab = new table_generator();
        $tab->init('table table-striped table-bordered', array('style' => 'width:100%;'));
        foreach ($json as $k => $v) {
            $btn_view = '<button type="button" data-href="'.$v['url'].'" data-type="'.$v['is_video'].'" class="btn btn-warning" onclick="modal_view(this)" >View</button>';
            $btn_download = '<a href="'.$v['url'].'" class="btn btn-success" tagget="blank">Download</a>';
            $tab->add_row2(array("name" => ($v['is_video']?"Video":"Image"), "data" => $btn_view.'&nbsp;'.$btn_download));
        }
        return $tab->generate();
    }
    //$json = json_decode('[{"display":"https:\/\/scontent-cgk1-2.cdninstagram.com\/v\/t51.2885-15\/e35\/135395150_1264728193896999_571755348064065855_n.jpg?_nc_ht=scontent-cgk1-2.cdninstagram.com&_nc_cat=1&_nc_ohc=B344G4GlKgkAX-3RBjc&tp=1&oh=77866449b7580be5f021ef68490c5fee&oe=5FF9269F","is_video":"true","url":"https:\/\/scontent-cgk1-2.cdninstagram.com\/v\/t50.2886-16\/135720584_492318078399923_7195443065659155101_n.mp4?_nc_ht=scontent-cgk1-2.cdninstagram.com&_nc_cat=111&_nc_ohc=JkPD00qYmA4AX-LiMlZ&oe=5FF92A58&oh=cb9c6b1460817acd563783bff8af0740"}]', true);
    
}


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
    /*echo htmlentities($data);
    echo '<hr>';*/
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
    if(empty($matches)){
        echo "<p class='lead' style='color:#F00'>Link tidak valid</p>";
        return;
    }
    $entry_data = $manage->entry_data;
    
    $type = $entry_data->PostPage[0]->graphql->shortcode_media->__typename;

    return $type($entry_data);
}


function GraphSidecar($val){
    $tab = new table_generator();
    $tab->init('table table-striped table-bordered', array('style' => 'width:100%;'));
    $edges = $val->PostPage[0]->graphql->shortcode_media->edge_sidecar_to_children->edges;
    foreach ($edges as $k => $v) {
        $row = [];
        $typename =  $v->node->__typename;
        if($typename=='GraphVideo'){
            $vidurl = $v->node->video_url;
            $row['name'] = $typename;
            $data = [];
            array_push($data, array('size'=>'-', 'url'=>$vidurl));
            $row['data'] = $data;
            $tab->add_row($row);
        }else{
            $display_resources = $v->node->display_resources;
            $accessibility_caption = $v->node->accessibility_caption;
            $row['name'] = "$typename. $accessibility_caption";
            $data = [];
            foreach ($display_resources as $a => $b) {
                $tmp = array(
                                'size' => "$b->config_width x $b->config_height",
                                'url' => $b->src,
                    );
                array_push($data, $tmp);
            }
            $row['data'] = $data;
            $tab->add_row($row);
        }
    }
    return $tab->generate();
}

function GraphImage($val){
    $tab = new table_generator();
    $tab->init('table table-striped table-bordered', array('style' => 'width:100%;'));
    $row = [];
    $shortcode_media = $val->PostPage[0]->graphql->shortcode_media;

    $typename =  $shortcode_media->__typename;
    $accessibility_caption = $shortcode_media->accessibility_caption;
    $display_resources = $shortcode_media->display_resources;
    $row['name'] = "$typename. $accessibility_caption";
    $data = [];
    foreach ($display_resources as $a => $b) {
        $tmp = array(
                        'size' => "$b->config_width x $b->config_height",
                        'url' => $b->src,
            );
        array_push($data, $tmp);
    }
    $row['data'] = $data;
    $tab->add_row($row);
    return $tab->generate();
}

function GraphVideo($val){
    $tab = new table_generator();
    $tab->init('table table-striped table-bordered', array('style' => 'width:100%;'));
    $row = [];
    $PostPage = $val->PostPage;
    $nol = $PostPage[0];
    $graphql = $nol->graphql;
    $shortcode_media = $graphql->shortcode_media;

    $typename =  $shortcode_media->__typename;
    $accessibility_caption = isset($shortcode_media->accessibility_caption)?$shortcode_media->accessibility_caption:'';
    $row['name'] = "$typename. $accessibility_caption";
    $data = [];
    if(isset($shortcode_media->video_url)){
        $video_url = $shortcode_media->video_url; 
        array_push($data, array('size' => '-', 'url' => $video_url));
    }else{
        if(isset($shortcode_media->edge_sidecar_to_children)){
            $edge_sidecar_to_children = $shortcode_media->edge_sidecar_to_children;
            $edges = $edge_sidecar_to_children->edges;
            $i=1;
            foreach ($edges as $key => $value) {
                $node = $value->node;
                $video_url = $node->video_url;
                $i++;
                array_push($data, array('size' => '-', 'url' => $video_url));
            }
        }else{
        }
        
    }
    $row['data'] = $data;
    $tab->add_row($row);
    return $tab->generate();
}



?>
