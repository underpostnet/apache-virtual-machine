<?php

include 'C:/xampp/htdocs/nexodev/modules/util.php';

function renderPath($uri, $str_data, $lang){


  $data = json_decode($str_data, true);

  for($i=0;$i<l($data['path']);$i++){

    if(($data['url'].$data['path'][$i]['url'])
            ==
      (explode("?",("http://".explode("/", $data['url'])[2].$uri))[0])){

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $path = $data['path'][$i];

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $h1 = "";

      for($ii=0;$ii<l($path['h1']);$ii++){

        $h1 = $h1."<h1>".$path['h1'][$ii][$lang]."</h1>";

      }

      $h2 = "";

      for($ii=0;$ii<l($path['h2']);$ii++){

        $h2 = $h2."<h2>".$path['h2'][$ii][$lang]."</h2>";

      }

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $global_css = "<style>".file_get_contents($data['ywork_file']."/style/".$path['main_css']);

      for($ii=0;$ii<l($path['modules']);$ii++){

        // $path['modules'][$ii]

        $global_css = $global_css.file_get_contents($data['path_file']."modules/".$path['modules'][$ii]."/style.css");

      }

      $global_css = $global_css."</style>";

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------


      $global_js = "<script>

      var path = '".$data['url']."';

      ".file_get_contents($data['ywork_file']."/build/client/vanilla.js")
      .file_get_contents($data['ywork_file']."/build/client/util.js");

      for($ii=0;$ii<l($path['modules']);$ii++){

        // $path['modules'][$ii]

        $global_js = $global_js.file_get_contents($data['path_file']."modules/".$path['modules'][$ii]."/main.js");

      }

      $global_js = $global_js."</script>";

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $microdata = '';

      for($ii=0;$ii<l($path['microdata']);$ii++){

        // $path['modules'][$ii]

        $microdata = $microdata.'<script type="application/ld+json">'
        .file_get_contents($data['path_file']."microdata/".$path['microdata'][$ii].".json")
        .'</script>';

      }

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      echo reduce("

      <!DOCTYPE html>

      <html dir='".$data['dir']."' lang='".lang($lang)."'>

        <head>

          <title>".$path['title'][$lang]."</title>

          ".$microdata."

          <meta name ='title' content='".$path['title'][$lang]."' />
          <meta name ='description' content='".$path['description'][$lang]."' />
          <meta name ='theme-color' content = '".$data['color']."' />
          <link rel='canonical' href='".$data['url'].$path['url']."' />
          <link rel='icon' type='image/png' href='".$data['url']."/assets/".$data['favicon']."' />

          <!-- app assets -->

          <meta property='og:title' content='".$path['title'][$lang]."' />
          <meta property='og:description' content='".$path['description'][$lang]."' />
          <meta property='og:image' content='".$data['url']."/assets/".$path['image']."' />
          <meta property='og:url' content='".$data['url'].$path['url']."' />
          <meta name='twitter:card' content='summary_large_image' />


          <meta name='viewport' content='initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
          <meta name='viewport' content='width=device-width, user-scalable=no' />

          ".$global_css.$global_js."

        </head>

        <body>

          ".$h1.$h2."

          <script  type='text/javascript' async defer>"
          .file_get_contents($data['path_file']."/path/".$path['main_js'])
          ."</script>

        </body>

      </html>

      ");

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------


    }

  }


}




 ?>
