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

function delayWait($seconds, $por_color_interval = null, $msgLog = "Loading..." ){
  global $fnColors;
  $indexColor = 0;
  $sumMicrosecond = 0;
  $sumDisplaysColor = 0;
  $max_por = 100;
  $factorLengthBar = 10;
  for($i=0; $i<=$max_por; $i++){
    if( $sumDisplaysColor == $por_color_interval
        or
        $por_color_interval == null ){
      $sumDisplaysColor = 0;
      $indexColor++;
      $indexColor >= count($fnColors) ?
      $indexColor = 0 : null;
    }
    $sumDisplaysColor++;
    // $displaySecond = intval(($sumMicrosecond / 1000000));
    $displaySecond = floatval(($sumMicrosecond / 1000000));
    $displaySecond = str_pad($displaySecond, 4, "0");
    // ASCII Text Art
    if($i%$factorLengthBar==0){
      $barDisplayOk = str_repeat("█", ($i/$factorLengthBar));
      $barDisplayWait = str_repeat("▒", (($max_por/$factorLengthBar)-($i/$factorLengthBar)));
    }
    echo $fnColors[$indexColor]
    ($msgLog." ".$barDisplayOk.$barDisplayWait."  {$i}%  {$displaySecond}/{$seconds}s \r");
    // sleep(1); -> seconds
    $intervalTime = ($seconds/$max_por)*1000*1000;
    usleep($intervalTime);
    $sumMicrosecond += $intervalTime;
    if($i==$max_por){
      echo $fnColors[$indexColor]
      ($msgLog." "
      .str_replace('█', ' ', $barDisplayOk.$barDisplayWait)
      ."  {$i}%  {$seconds}/{$seconds}s            \r");
    }
  }
  echo "\n";
}

 ?>
