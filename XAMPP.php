<?php

/*


3001,
3002,
3003,
3004


*/

function XAMPP($delay_){

  global $main_config;

  p_y(" > INIT XAMPP \n");

  delayWait($delay_);
  p_c(" > xampp_stop \n");
  echo exec('c:/xampp/xampp_stop.exe');
  echo " \n";

  foreach ($main_config->ports as $value_port) {
    delayWait(1);
    p_c(" > npx kill-port ".$value_port." \n");
    echo exec("npx kill-port ".$value_port);
    echo " \n";
  }

  delayWait($delay_);
  p_c(" > xampp_start \n");
  echo exec('c:/xampp/xampp_start.exe');
  echo " \n";
  delayWait($delay_);

}

?>
