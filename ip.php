<?php

$ip_api_array = array(

	['http://ipecho.net/plain',false],
	// ['https://ident.me/',false],
	['https://v4.ident.me/',false],
	['https://api.ip.sb/ip',false],
	['https://api-ipv4.ip.sb/ip',false],
	['https://api.ipify.org/?format=json',true],
	['https://api64.ipify.org/?format=json',true]

);

function getNewIp(){
  global $ip_api_array;
  $succes = false;
  $aux_ip = "";
  for($ip_i=0;$ip_i<count($ip_api_array);$ip_i++){

      if(!$succes){

        if($ip_api_array[$ip_i][1]){

          $aux_ip = json_decode(file_get_contents($ip_api_array[$ip_i][0]), true)['ip'];
          if(filter_var($aux_ip, FILTER_VALIDATE_IP)){
            echo "getIP:".$ip_api_array[$ip_i][0];
            $succes = true;
          }

        }else{

          $aux_ip = file_get_contents($ip_api_array[$ip_i][0]);
          if(filter_var($aux_ip, FILTER_VALIDATE_IP)){
            echo "getIP:".$ip_api_array[$ip_i][0];
            $succes = true;
          }

        }

      }

    }
    return [$succes, $aux_ip];
}

?>
