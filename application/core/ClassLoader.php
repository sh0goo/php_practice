<?php
/**
 * Created by PhpStorm.
 * User: sh0g0
 * Date: 2018/02/20
 * Time: 23:58
 */

/**
 * Class ClassLoader
 * オートロードに関する処理をまとめたクラス
 */
class ClassLoader
{

    protected $dirs;

    /**
     * PHPにオートローダークラスを登録
     */
    public function register()
    {
        // loadClass関数が、オートロード時にコールバックされる
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * @param $dir オートロードの対象とするディレクトリへのフルパス
     */
    public function registerDir($dir)
    {
        $this->dirs[] = $dir;
    }

    /**
     * クラスファイルの読み込み
     * @param $class 読み込むクラスファイル名
     */
    public function loadClass($class)
    {
        foreach ($this->dirs as $dir) {
            $file = $dir.'/'.$class.'.php';
            if(is_readable($file)){
                require $file;
                return;
            }
        }
    }
}