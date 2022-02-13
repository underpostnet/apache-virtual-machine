<?php

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$ip = null;
$cont = 0;

function dns(){

	//---------------------------------------------------
	//---------------------------------------------------

	global $domains;
	global $ip;
	global $cont;
	global $ansi;
	global $main_config;

	$ip = $main_config->last_ip;

	//---------------------------------------------------
	//---------------------------------------------------

		$aux_ip = getNewIp();

		if( $aux_ip[0] and ($ip!=$aux_ip[1]) ){

			$ip=$aux_ip[1];
			$main_config->last_ip = $ip;
			$cont++;

			$file = fopen('./config.json', "w");
			fwrite($file, json_encode($main_config, JSON_PRETTY_PRINT));
			fclose($file);

			echo '', "\n";
			echo '-----', "\n";
			echo '', "\n";
			p_c( ('NEW IP:'.$ip. "\n") );
			p_c( ('CONT:'.$cont. "\n") );
			echo '', "\n";

			foreach ($domains as $dataDomain) {
				// echo "\x1B(0" . chr(0147) -> ???
				 p_g('LOAD DNS DOMAIN -> '.$dataDomain->name. "\n");
				foreach ($dataDomain->subdomain as $dataSubDomain) {

					updateDomain($dataDomain, $dataSubDomain, $ip);

					sleep(1);
				}
				echo "\n\n";
			}

			XAMPP($main_config->xampp_delay);
			testAllDomain();

		}

		// verifi auto block disable -> on
		echo trim(file_get_contents(('http://'.$ip)));

}


 ?>
