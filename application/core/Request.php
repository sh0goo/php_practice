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

    public function getRequestUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }
}