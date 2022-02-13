<?php

include '..\console.php';
include '.\update.php';

// json_decode option enable edit -> , true
$domains = json_decode(file_get_contents( "../domains.json" ));
// var_dump($domains[0]);

foreach ($domains as $dataDomain) {

	 p_g('LOAD DNS DOMAIN -> '.$dataDomain->name. "\n");
	foreach ($dataDomain->subdomain as $dataSubDomain) {

        ($dataSubDomain->ssl_path!=null)and($dataSubDomain->name!="www.") ?
        updateSSL($dataSubDomain->ssl_path, $dataDomain->name, $dataSubDomain->name)
        : null;
	}
	echo "\n\n";
}

 ?>
