 <?php

//explode("separador", str);
//str_replace(array("\n","\r","\t"),'',"");

function reduce($str){

  return str_replace(array("\n","\r","\t"),'',$str);

}

function l($obj){

		return count($obj);

}

function lang($id){

	if($id==1){

		return 'es';

	}else{

		return 'en';

	}

}

?>
