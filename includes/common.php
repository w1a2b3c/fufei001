<?php
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('TEMPLATE_ROOT',ROOT.'/template/');
define('SYS_KEY', '86b4aa7d2e16334e92126abb4703f918');
date_default_timezone_set("PRC");
$date = date('Y-m-d H:i:s');
session_start();

if(!file_exists('../install/install.lock')){
    header("Location: /install");
}

$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';

require SYSTEM_ROOT.'config.php';

//连接数据库
include_once(SYSTEM_ROOT."db.class.php");
$DB=new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);

$sql = $DB->query("select * from site_config");

//获取系统配置
while($r = $DB->fetch($sql)){
    $conf[$r['k']] = $r['v'];
}


$password_hash='!@#%!s!';
include_once(SYSTEM_ROOT."function.php");
include_once(SYSTEM_ROOT."core.func.php");
include_once(SYSTEM_ROOT."member.php");
?>