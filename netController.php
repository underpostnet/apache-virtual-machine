
<?php

function is_connected()
{
    $connected = @fsockopen("google.cl", 80);
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

function checkAdminStatus(){
  $admin_status = exec('admin.bat');
  if($admin_status=="SUCCESS"){
    p_c(" > Admin status success \n");
  }else{
    p_r(" > Admin status error \n");
    exit();
  }
}

$checkNetStatusError = 0;
function checkNetStatus(){

  global $main_config;
  global $checkNetStatusError;

  // ip config
  // ports -> netstat -a -b
  // netsh wlan show networks
  // netsh wlan connect ssid="VERDUGO" name="VERDUGO"

  /*

  netsh wlan show interfaces  -> netsh interface set interface name="[Name]"
  netsh interface set interface name="Wi-Fi" admin="DISABLED"
  netsh interface set interface name="Wi-Fi" admin="ENABLED"

  en 5 intento de coenccion seguidor usar esto

  */

  p_y(" > check net status \n");
  switch (is_connected()) {
    case true:
      p_y(" > network connected \n");
      break;

    default:
      $checkNetStatusError++;
      p_r(" > network disconnected attempt:".$checkNetStatusError."\n");
      p_y(" > network connecting ... \n");
      echo exec('netsh wlan connect ssid="'.$main_config->wlan_ssid.'" name="'.$main_config->wlan_name.'"');
      echo "\n";
      delayWait(4);
      if($checkNetStatusError==5){
        p_c(" > Reset wifi adapter ... \n");
        p_y(" > wifi off ... \n");
        echo exec('netsh interface set interface name="'.$main_config->netsh_interface_name.'" admin="DISABLED"');
        echo "\n";
        delayWait(10);
        p_y(" > wifi on ... \n");
        echo exec('netsh interface set interface name="'.$main_config->netsh_interface_name.'" admin="ENABLED"');
        echo "\n";
        delayWait(10);
        $checkNetStatusError = 0;
      }
      checkNetStatus();
      break;
  }

}




?>
