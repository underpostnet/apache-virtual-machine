<?php

include '.\DNS\main.php';
include '.\DNS\updateDomain.php';
include '.\DNS\testDomain.php';
include '.\SSL\update.php';
include '.\ip.php';
include '.\console.php';
include '.\errors.php';
include '.\delay.php';
include '.\XAMPP.php';
include '.\netController.php';

// json_decode option enable edit -> , true
$domains = json_decode(file_get_contents( "./domains.json" ));
$main_config = json_decode(file_get_contents( "./config.json" ));
// var_dump($domains[0]);

/*

$file = fopen('./test.json', "w");
fwrite($file, json_encode($json, JSON_PRETTY_PRINT));
fclose($file);

*/

// https://www.php.net/manual/es/timezones.php
date_default_timezone_set($main_config->timezone);


// https://manytools.org/hacker-tools/convert-images-to-ascii-art/
// https://realfavicongenerator.net/favicon/node_cli#.YTlVu51KjIU
echo p_y("

  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@                       @@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@       @@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@         @@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@           @@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@    #   @    @@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@    @#   @@    @@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@    @@#   @@@    @@@@@@@@@@@@@@
  @@@@@@@@@@@@@@                   @@@@@@@@@@@@@
  @@@@@@@@@@@@@    @@@@#   @@@@@    @@@@@@@@@@@@
  @@@@@@@@@@@@    @@@@@#   @@@@@@    @@@@@@@@@@@
  @@@@@@@@@@@    @@@@@@#   @@@@@@@    @@@@@@@@@@
  @@@@@@@@@@    @@@@@@@#   @@@@@@@@    @@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

 > custom-apache
 > VIRTUAL MACHINE SYSTEM v1.5.0
 > DOGMADUAL.com

");

if ($main_config->prod) {
  echo p_c(" > PRODUCTION MODE \n");
  checkAdminStatus();
} else{
  echo p_c(" > DEVELOPMENT MODE \n");
  $main_config->ports[0] = 90;
}

checkNetStatus();
XAMPP($main_config->xampp_delay);

function mainProcess(){

	global $main_config;

	try {
		while(true){
      echo "\n\n";
      checkNetStatus();
			if($main_config->prod){
        echo "pfn->"; // productions functions
        dns();
        // mailer();
      }
      $time_machine = new DateTime();
      echo "\n";
      echo p_y(" > ".$time_machine->format('Y-m-d H:i:s'));
			sleep($main_config->main_process_delay);
		}
	} catch (Exception $e) {
	    // echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			echo "\n";
			p_r( "error -> \n" );
			echo $e;
			echo "\n";
			p_y( "ReStart Main Proccess -> \n" );
			delayWait(2);
			mainProcess();
	}
}

mainProcess();


 ?>
