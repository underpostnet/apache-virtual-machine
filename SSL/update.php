<?php

$mainPathSSL = "c:/dd/virtual_machine/SSL/";

function updateSSL($path, $domain, $subdomain){

  global $mainPathSSL;
  $name_domain = $subdomain.$domain;

  $gen_test_doc =
  [
    //"-chain-only.pem",
    "-chain.pem",
    "-crt.pem",
    "-key.pem"
  ];

  // echo "\n";
  // p_p("-- Update SSL -- \n");
  // p_c("path: -> ".$path."\n");
  // p_c("domain: -> ".$name_domain."\n");
  // p_p("---------------- \n");

  foreach($gen_test_doc as $type){

    $path_test = $mainPathSSL.$path."/".$name_domain.$type;

    if(file_exists($path_test)){

      if($type=="-chain.pem"){

        p_c("SSL UPDATE \n");

        $ssl_dir = $mainPathSSL.$path."/ssl/ca_bundle.crt";
        // echo 'generate -> '.$path_test." to ".$ssl_dir. "\n";
      }
      if($type=="-crt.pem"){
        $ssl_dir = $mainPathSSL.$path."/ssl/crt.crt";
        // echo 'generate -> '.$path_test." to ".$ssl_dir. "\n";
      }
      if($type=="-key.pem"){
        $ssl_dir = $mainPathSSL.$path."/ssl/key.key";
        // echo 'generate -> '.$path_test." to ".$ssl_dir. "\n";
      }
      p_p("generate -> ".$path_test." to ".$ssl_dir. "\n");
      rename($path_test, $ssl_dir);
    }
  }




}











 ?>
