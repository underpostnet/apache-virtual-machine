<?php

include 'C:/dd/deploy_area/nexodev/modules/util.php';

function renderPath($uri, $str_data, $lang){


  $data = json_decode($str_data, true);

  for($i=0;$i<l($data['path']);$i++){

    if(


      (

      ($data['url'].$data['path'][$i]['url'])
            ==
      strtolower((explode("?",("https://".explode("/", $data['url'])[2].$uri))[0]))

      )

      or

      (

        ($data['url'].$data['path'][$i]['url'].'index.php')
              ==
        strtolower((explode("?",("https://".explode("/", $data['url'])[2].$uri))[0]))

      )


    ){

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

      $global_css = "<style>".file_get_contents("c:/dd/deploy_area/client/style/".$path['main_css']);

      $global_css = $global_css . "

      @font-face {
      	font-family: 'nunito';
      	src: URL('".$data['url']."/assets/fonts/Nunito-Regular.ttf') format('truetype');
      }

      body, html {

        font-family: 'nunito';

      }

      a {

        text-decoration: none;

      }

      ";

      for($ii=0;$ii<l($path['modules']);$ii++){

        // $path['modules'][$ii]

        $global_css = $global_css.file_get_contents($data['path_file']."modules/".$path['modules'][$ii]."/style.css");

      }

      $global_css = $global_css."</style>";

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $str_cap = "";

      if(
        
        ($path['main_js']=='productos.js')
        or
        ($path['main_js']=='promociones.js')

      ){

        $str_cap = "<script type='text/javascript'>

          var grecaptchaTest;
          var onloadCallback = function() {
            grecaptcha.render('test-recaptcha', {
              'sitekey' : '".$data['gcap']."'
            });
            grecaptchaTest = grecaptcha;
          };

          function isCaptchaChecked() {
            return grecaptchaTest && grecaptchaTest.getResponse().length !== 0;
          }

        </script>


        <script
        type='text/javascript'
        src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=es'
        async defer></script>

        ";

      }

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $global_js = "<script>

      var path = '".$data['url']."';
      var path_ = '".$data['path'][$i]['url']."';

      ".file_get_contents("c:/dd/deploy_area/client/vanilla.js")
      .file_get_contents("c:/dd/deploy_area/client/util.js");

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      if($path['main_js']=='productos.js'){

        $global_js = $global_js."

          var data_productos = `".file_get_contents('c:/dd/global_data/json/fuenterayen/productos.json')."`;
          data_productos = JSON.parse(data_productos);
          /* console.log(data_productos); */

        ";

      }

      if($path['main_js']=='home.js'){

        $global_js = $global_js."

          var data_promociones = `".file_get_contents('c:/dd/global_data/json/fuenterayen/promociones.json')."`;
          data_promociones = JSON.parse(data_promociones);
          /* console.log(data_promociones); */

        ";

      }

      if($path['main_js']=='promociones.js'){

        $global_js = $global_js."

          var data_promociones = `".file_get_contents('c:/dd/global_data/json/fuenterayen/promociones.json')."`;
          data_promociones = JSON.parse(data_promociones);
          /* console.log(data_promociones); */

        ";

      }

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

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

      echo ("

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


          <script async src='https://www.googletagmanager.com/gtag/js?id=".$data['googletag']."'></script>

          <script>

          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '".$data['googletag']."');

          </script>


          ".$str_cap."


          <link rel='apple-touch-icon' sizes='180x180' href='".$data['url']."/assets/app/apple-touch-icon.png'>
          <link rel='icon' type='image/png' sizes='32x32' href='".$data['url']."/assets/app/favicon-32x32.png'>
          <link rel='icon' type='image/png' sizes='16x16' href='".$data['url']."/assets/app/favicon-16x16.png'>

          <link rel='icon' type='image/png' sizes='36x36' href='".$data['url']."/assets/app/android-chrome-36x36.png'>
          <link rel='icon' type='image/png' sizes='48x48' href='".$data['url']."/assets/app/android-chrome-48x48.png'>
          <link rel='icon' type='image/png' sizes='72x72' href='".$data['url']."/assets/app/android-chrome-72x72.png'>
          <link rel='icon' type='image/png' sizes='96x96' href='".$data['url']."/assets/app/android-chrome-96x96.png'>
          <link rel='icon' type='image/png' sizes='144x144' href='".$data['url']."/assets/app/android-chrome-144x144.png'>
          <link rel='icon' type='image/png' sizes='192x192' href='".$data['url']."/assets/app/android-chrome-192x192.png'>
          <link rel='icon' type='image/png' sizes='256x256' href='".$data['url']."/assets/app/android-chrome-256x256.png'>
          <link rel='icon' type='image/png' sizes='384x384' href='".$data['url']."/assets/app/android-chrome-384x384.png'>

          <link rel='icon' type='image/png' sizes='16x16' href='".$data['url']."/assets/app/favicon-16x16.png'>
          <link rel='manifest' href='".$data['url']."/assets/app/site.webmanifest'>
          <link rel='mask-icon' href='".$data['url']."/assets/app/safari-pinned-tab.svg' color='".$data['color']."'>

          <meta name='apple-mobile-web-app-title' content='".$path['title'][$lang]."'>
          <meta name='application-name' content='".$path['title'][$lang]."'>
          <meta name='msapplication-config' content='".$data['url']."/assets/app/browserconfig.xml' />
          <meta name='msapplication-TileColor' content='".$data['color']."'>
          <meta name='msapplication-TileImage' content='".$data['url']."/assets/app/mstile-144x144.png'>
          <meta name='theme-color' content='".$data['color']."'>


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
