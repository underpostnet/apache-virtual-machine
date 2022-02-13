<?php



function testSingleDomain($dataDomain, $dataSubDomain){

  p_y("test domain response ".$dataSubDomain->name.$dataDomain->name."-> \n");
  try {
    p_p( explode("</title>", explode("<title>",
    file_get_contents(("http://".$dataSubDomain->name.$dataDomain->name)))[1])[0]);
  } catch (Exception $e) {
     p_r("error domain not valid");
  }
  echo "\n";

}

function testAllDomain(){

  global $domains;

  foreach ($domains as $dataDomain) {
    // echo "\x1B(0" . chr(0147) -> ???
     p_g('LOAD DNS TEST DOMAIN -> '.$dataDomain->name. "\n");
    foreach ($dataDomain->subdomain as $dataSubDomain) {

      testSingleDomain($dataDomain, $dataSubDomain);
      delayWait(2);

    }
    echo "\n\n";
  }

}











 ?>
