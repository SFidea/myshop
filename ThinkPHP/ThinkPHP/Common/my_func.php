<?php

function inject_check($str){
    $tmp=preg_match('select|sleep|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $str);
    if($tmp){
        return 0;
    }else{
        return $str;
    }
}

/*intval 数字数组过滤转换*/
function array_num_check($data,$default=0){
    $default = intval($default);
    foreach($data as $key=>$vo){
        $vo = intval($vo);
        $data[$key] = empty($vo) ? $default : $vo ;
    }
    return $data;
}

//api传值
function post_json($data,$url){
    $post_data = array(
        'data' => json_encode($data),
    );
    ksort($post_data);
    $content = http_build_query($post_data);
    $content_length = strlen($content);
    $options = array('http' => array(
        'method' => 'POST',
        'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-length: $content_length\r\n",
        'content' => $content
    )
    );
    $res = file_get_contents($url, false, stream_context_create($options));
    return $res;
}
//api传值
function get_json($url){
    $res=file_get_contents($url);
    return $res;
}



