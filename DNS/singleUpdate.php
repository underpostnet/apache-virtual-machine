<?php

include '..\console.php';
include '..\errors.php';
include '..\ip.php';
include '..\SSL\update.php';
include '.\testDomain.php';
include '.\updateDomain.php';
include '..\delay.php';

// json_decode option enable edit -> , true
$domains = json_decode(file_get_contents( "../domains.json" ));
// var_dump($domains[0]);

$inputDomain = readline("Dominio: ");
$ip = getNewIp();
// $ip = [false, "xxx"];

if($ip[0]){

  echo '', "\n";
  p_c( ('GET IP:'.$ip[1]. "\n") );
  echo '', "\n";

  foreach ($domains as $dataDomain) {
    if($dataDomain->name==$inputDomain){
      echo "\n";
      p_g('LOAD DNS DOMAIN -> '.$dataDomain->name. "\n");
      foreach ($dataDomain->subdomain as $dataSubDomain) {
        updateDomain($dataDomain, $dataSubDomain, $ip[1]);
        delayWait(5);
        testSingleDomain($dataDomain, $dataSubDomain);
      }
      echo "\n\n";
      exit("end update single domain \n");
    }
  }
}else{
  echo "\n";
  p_r("corrupt ip -> ".$ip[1]);
  exit();
}
echo "\n";
p_r("domain not found");






















 ?>
