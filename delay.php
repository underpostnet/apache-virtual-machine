<?php


function delayWait($time){
  for($i=0; $i<=$time; $i++){
    echo "delayWait() ->  ".$i."/".$time."  \n";
    sleep(1);
  }
}


 ?>
