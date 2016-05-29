<?php
namespace Home\Util;

/**
 * 基于 CURL 的 Http 客户端
 **/
class HttpClient
{

    public static function Request($url , $data ,$type = 'GET' ,$file = 0 )
    {
        if(empty($url)) {
            return false; 
        }

        $curlHandle = curl_init();
        curl_setopt($curlHandle ,CURLOPT_RETURNTRANSFER ,1);
        curl_setopt($curlHandle ,CURLOPT_HEADER , 0);

        $param = $data;
        if($file == 0 ) {
            $param = self::buildQuery($data);
        }

        $method = strtoupper($type);

        switch ($method) {
            case 'GET':
                curl_setopt($curlHandle ,CURLOPT_URL ,($url . '?' . $param));
                break;
            case 'POST':
                curl_setopt($curlHandle ,CURLOPT_URL ,$url);
                curl_setopt($curlHandle ,CURLOPT_POST ,1);
                curl_setopt($curlHandle ,CURLOPT_POSTFIELDS ,$param);
                break;
        }

        $response = curl_exec($curlHandle);
        curl_close($curlHandle);

        return $response;
    }

    public static function Get ($url ,$data = array() ,$is_decode = false) 
    {
        $res = self::Request($url ,$data ,'GET');

        if($is_decode === true) {
            return json_decode($res);
        }

        return $res;
    }

    public static function Post ($url ,$data = array() ,$is_decode = false )
    {
        $res = self::Request ($url ,$data ,'POST' ,0 );
        if($is_decode === true) {
            return json_decode($res);
        }

        return $res;
    }

    public static function PostFile ($url ,$data = array() ,$is_decode = false) 
    {
        $res = self::Request ($url ,$data ,'POST' ,1);
        if($is_decode === true) {
            return json_decode($res);
        }

        return $res;
    }

    public static function buildQuery($data) {
        return http_build_query($data);
    }
    
}
