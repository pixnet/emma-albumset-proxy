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
    $api->setCurlOptions(array(CURLOPT_PROXY => 'proxy.srv.pixnet:3128'));
}

switch ($_GET['service']) {
case 'element':
    $json = $api->http('http://emma.pixnet.cc/album/elements', array('get_params' => array(
        'set_id' => intval($_GET['set_id']),
        'type' => 'pic',
        'with_detail' => 1,
        'per_page' => 1000
    )));
    break;
case 'set':
    $json = $api->http('http://emma.pixnet.cc/album/sets/' . intval($_GET['set_id']),
        array('get_params' => array('user' => strval($_GET['user']))));
    break;
}
