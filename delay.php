<?php

// include '.\console.php';
// var_dump($fnColors);
// 1s -> 1*1000*1000 µs microsecond

/*

$input = "Alien";
echo str_pad($input, 10);                      // produces "Alien     "
echo str_pad($input, 10, "-=", STR_PAD_LEFT);  // produces "-=-=-Alien"
echo str_pad($input, 10, "_", STR_PAD_BOTH);   // produces "__Alien___"
echo str_pad($input, 6 , "___");               // produces "Alien_"


*/

function delayWait($seconds, $por_color_interval = null){
  global $fnColors;
  $indexColor = 0;
  $sumMicrosecond = 0;
  $sumDisplaysColor = 0;
  for($i=0; $i<=100; $i++){
    if( $sumDisplaysColor == $por_color_interval
        or
        $por_color_interval == null ){
      $sumDisplaysColor = 0;
      $indexColor++;
      $indexColor >= count($fnColors) ?
      $indexColor = 0 : null;
    }
    $sumDisplaysColor++;
    $displaySecond = intval(($sumMicrosecond / 1000000));
    // $floatSecond = floatval(($sumMicrosecond / 1000000));
    echo $fnColors[$indexColor]
    ("Loading... {$i}%  {$displaySecond}/{$seconds}s \r");
    // sleep(1); -> seconds
    $intervalTime = ($seconds/100)*1000*1000;
    usleep($intervalTime);
    $sumMicrosecond += $intervalTime;
  }
  echo "\n";
}

 ?>
