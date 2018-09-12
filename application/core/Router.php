<?php
/**
 * Created by PhpStorm.
 * User: sh0g0
 * Date: 2018/02/24
 * Time: 13:42
 */

/**
 * Class Router
 * ルーティング定義配列と、PATH_INFOを受け取り、ルーティングパラメータを特定
 */
class Router
{

    protected $routes;

    public function __construct($definitions)
    {
        $this->routes = $this->compileRoutes($definitions);
    }

    /**
     * ルーティング定義配列を変換
     * @param $definitions
     */
    public function compileRoutes($definitions)
    {
        $this->routes = array();

        foreach ($definitions as $url => $param){
            $tokens = explode('/', ltrim($url, '/'));

        }
    }

}