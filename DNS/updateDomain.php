<?php


function updateDomain($dataDomain, $dataSubDomain, $ip){

  switch ($dataDomain->dns) {
      case 'dondominio':
        echo "name subdomain -> \n";
        $dataSubDomain->name=="" ? p_y("/") : p_y($dataSubDomain->name);
        echo "\n";
        echo "ssl path -> ".$dataSubDomain->ssl_path. "\n";
        echo "dns update request -> \n";
        $query = 'https://dondns.dondominio.com/json/?user='
        .$dataDomain->user.'&password='.$dataDomain->api_key.'&host='.$dataSubDomain->name.$dataDomain->name.'&ip='.$ip;
        echo $query, "\n";
        echo "dns response request -> \n";
        echo file_get_contents($query), "\n";

        ($dataSubDomain->ssl_path!=null)and($dataSubDomain->name!="www.") ?
        updateSSL($dataSubDomain->ssl_path, $dataDomain->name, $dataSubDomain->name)
        : null;
      break;

    default:
      p_r(" Invalid DNS service -> ".$dataDomain->dns);
      break;
  }

}


 ?>
