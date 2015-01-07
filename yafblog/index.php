<?php

/**
 * @copyright Copyright(c) 2014 yafblog.com
 * @file index.php
 * @author Lujunjian <hackmyth@163.com>
 * @date 2014-03-27
 * @version 0.1.2
 */
error_reporting(-1);

define('APPLICATION_PATH', dirname(__FILE__));

//应用名称
define("APP_NAME", 'App');

//版本
define("VERSION", '0.1.2');

//开启调试
define("DEBUG", true);


/**
 * 
 * 后台模块名称
 * 因本程序属于开源程序,如果不修改默认的后台模块名称,很可能会产生全问题.
 * 
 * 操作步骤:
 * 
 *        1、修改此处后,请求原路径,则会自动修改模块目录,根据提示修改。
 *        2、请到conf/yafblog.ini文件中,将相应的模块名修改成新的模块名,则生效。
 * 
 */
define('ADMIN_NAME','admin');


$application = new Yaf_Application( APPLICATION_PATH . "/conf/yafblog.ini");
$application->bootstrap()->run();





?>
