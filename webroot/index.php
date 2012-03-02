<?php
require_once('bootstrap.php');
require_once('PixAPI.php');

if ($_GET['sig'] != crc32(SHARED_SECRET . $_GET['set_id'])) {
    echo json_encode(array('error' => 1, 'message' => 'signature error'));
    exit;
}

$api = new PixAPI(CONSUMER_KEY, CONSUMER_SECRET);
$api->setToken(ACCESS_TOKEN, ACCESS_SECRET);
if (DOMAIN_APPEND) {
    $api->setCurlOptions(array(
        CURLOPT_PROXY => 'proxy.srv.pixnet:3128'
    ));
}

//print_r(json_decode($api->http('http://emma.pixnet.cc/album/sets/16254219', array('get_params' => array('user' => 'movieca')))));
print_r(json_decode($api->http('http://emma.pixnet.cc/album/elements', array('get_params' => array('set_id' => 16254219, 'type' => 'pic', 'with_detail' => 1)))));
