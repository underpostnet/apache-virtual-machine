<?php

require 'vendor/autoload.php';

use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\Writers\StreamWriter;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

// Create Ansi Instance
// https://github.com/bramus/ansi-php
$ansi = new Ansi(new StreamWriter('php://stdout'));

// Output some styled text on screen, along with a Line Feed and a Bell

/* $ansi->color(array(SGR::COLOR_FG_RED, SGR::COLOR_BG_WHITE))
     ->blink()
     ->text('I will be blinking red on a white background.')
     ->nostyle()
     ->text(' And I will be normally styled.')
     ->lf()
     ->text('Ooh, a bell is coming ...')
     ->bell(); */

function p_y($str){
	// yellow
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_YELLOW))->text($str);
	$ansi->reset();
}

function p_r($str){
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_RED))->text($str);
	$ansi->reset();
}

function p_g($str){
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_GREEN))->text($str);
	$ansi->reset();
}

function p_b($str){
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_BLUE))->text($str);
	$ansi->reset();
}

function p_c($str){
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_CYAN))->text($str);
	$ansi->reset();
}

function p_p($str){
	global $ansi;
	$ansi->color(array(SGR::COLOR_FG_PURPLE))->text($str);
	$ansi->reset();
}


$fnColors = [
	"p_y",
	"p_r",
	"p_g",
	"p_b",
	"p_c",
	"p_p"
];



?>
