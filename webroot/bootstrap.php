<?php
$server_name = $_SERVER['SERVER_NAME'];
$node = explode('.', $server_name);
if ($node[count($node) - 1] == 'pixnet') {
    define('DOMAIN_APPEND', '.' . implode('.', array_slice($node, -3)));
} else {
    define('DOMAIN_APPEND', '');
}

$baseDir = __DIR__;
set_include_path(get_include_path() . PATH_SEPARATOR . "$baseDir/../libs");

if (DOMAIN_APPEND && file_exists("$baseDir/../debug.php")) {
    require_once("$baseDir/../debug.php");
} else {
    define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
    define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
    define('ACCESS_TOKEN', getenv('ACCESS_TOKEN'));
    define('ACCESS_SECRET', getenv('ACCESS_SECRET'));
    define('SHARED_SECRET', getenv('SHARED_SECRET'));
}
