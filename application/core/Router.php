<?php

 /**
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
    public function compileRoutes(array $definitions): array
    {
        $this->routes = [];

        foreach ($definitions as $url => $params){
            // スラッシュごとに分割
            $tokens = explode('/', ltrim($url, '/'));
            foreach ($tokens as $i => $token) {
                if (0 === strpos($token, ':')) {
                    // 分割した値の中にコロンで始まる文字列があった場合
                    $name = substr($token, 1);
                    $token = '(?P<'. $name . '>[^/]+)';
                }
                $tokens[$i] = $token;
            }

            $pattern = '/' . implode('/', $tokens);
            $routes[$pattern] = $params;
        }

        return $routes;
    }

    public function resolve (string $path_info)
    {
        if ('/' !== substr($path_info, 0, 1)) {
            // 先頭がスラッシュでなかった場合、スラッシュを付与
            $path_info = '/' . $path_info;
        }

        foreach ($this->$routes as $pattern => $params) {
            
            if (preg_match('#^' . $pattern . '$#', $path_info, $matches)) {
                $params = array_merge($params, $matches);
                return $params;
            }
        }
        return false;
    }
}