<?php

$domains = json_decode(file_get_contents( "../domains.json" ));
include '../console.php';

// https://stackoverflow.com/questions/6863948/how-to-get-expiry-date-from-the-ssl-certificate-file-in-php

function getInfoSSL($url){

  // $url = "https://www.nexodev.org";
  $orignal_parse = parse_url($url, PHP_URL_HOST);
  $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
  $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
  $cert = stream_context_get_params($read);
  $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

  // var_dump($cert);

  // var_dump($certinfo);

  $valid_from = date(DATE_RFC2822,$certinfo['validFrom_time_t']);
  $valid_to = date(DATE_RFC2822,$certinfo['validTo_time_t']);
   p_y("Domain: ".$url."\n");
   p_g("-> Valid From: ".$valid_from."\n");
   p_g("-> Valid To:".$valid_to."\n");
   echo "\n";

}

foreach ($domains as $dataDomain) {
  foreach ($dataDomain->subdomain as $dataSubDomain) {
    ($dataSubDomain->ssl_path!=null)and($dataSubDomain->name!="www.") ?
    getInfoSSL(("https://".$dataSubDomain->name.$dataDomain->name."/"))
    : null;
    sleep(1);
  }
}


 ?>
