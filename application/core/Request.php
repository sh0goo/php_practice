<?php
/**
 * Created by PhpStorm.
 * User: sh0g0
 * Date: 2018/02/21
 * Time: 1:02
 */

/**
 * Class Request
 * リクエスト情報を制御
 */
class Request
{
    /**
     * @return bool HTTPメソッド判定
     */
    public function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }

        return false;
    }

    public function getGet($name, $default = null)
    {
        if(isset($_GET[$name])){
            return $_GET[$name];
        }

        return $default;
    }

    public function getPost($name, $default = null)
    {
        if(isset($_POST[$name])){
            return $_POST[$name];
        }

        return $default;
    }

    /**
     * @return mixed サーバホスト名を返却
     */
    public function getHost()
    {
        if(!empty($_SERVER['HTTP_HOST'])){
            return $_SERVER['HTTP_HOST'];
        }

        return $_SERVER['SERVER_NAME'];
    }

    public function isSsl()
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            return true;
        }

        return false;
    }

    /**
     * リクエストされたURI情報を取得
     * @return mixed
     */
    public function getRequestUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * ベースURLを取得
     *
     * @return mixed
     */
    public function getBaseUrl()
    {

        $script_name = $_SERVER['SCRIPT_NAME'];

        // リクエストされたURI
        $request_uri = $this->getRequestUrl();

        // 第一引数に指定した文字列中から、第二引数に指定した文字列が最初に出現する位置を返す
        if(0 === strpos($request_uri, $script_name)){
            // フロントコントローラが、URLに含まれる場合
            return $script_name;
        }elseif (0 === strpos($request_uri, dirname($script_name))){
            return rtrim(dirname($script_name), '/');
        }

        return '';
    }

    public function getPathInfo()
    {
        $base_url = $this->getBaseUrl();

        // リクエストされたURI
        $request_uri = $this->getRequestUrl();

        if(false !== ($pos = strpos($request_uri. '?'))){
            $request_uri = substr($request_uri, 0 , $pos);
        }

        $path_info = (string)substr($request_uri, strlen($base_url));

        return $path_info;
    }
}