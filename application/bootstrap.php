<?php
/**
 * Created by PhpStorm.
 * User: sh0g0
 * Date: 2018/02/21
 * Time: 0:49
 */

// この段階では、クラスは読み込まれていないので、明示的に読み込む
require 'core/ClassLoader.php';

$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');
$loader->register();