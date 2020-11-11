<?php

include 'C:/xampp/htdocs/nexodev/modules/util.php';

function renderPath($uri, $str_data, $lang){


  $data = json_decode($str_data, true);

  for($i=0;$i<l($data['path']);$i++){

    if(($data['url'].$data['path'][$i]['url'])==("http://".explode("/", $data['url'])[2].$uri)){

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      $path = $data['path'][$i];

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------

      echo reduce("

      <!DOCTYPE html>

      <html dir='".$data['dir']."' lang='".lang($lang)."'>

        <head>

          <title>".$path['title'][$lang]."</title>

          <meta name ='title' content='".$path['title'][$lang]."' />
          <meta name ='description' content='".$path['description'][$lang]."' />
          <meta name ='theme-color' content = '".$data['color']."' />
          <link rel='canonical' href='".$data['url'].$path['url']."' />
          <link rel='icon' type='image/png' href='".$data['url']."/assets/".$data['favicon']."' />


          <link rel='apple-touch-icon' sizes='180x180' href='".$data['url']."/assets/app/apple-touch-icon.png'>
          <link rel='icon' type='image/png' sizes='32x32' href='".$data['url']."/assets/app/favicon-32x32.png'>
          <link rel='icon' type='image/png' sizes='194x194' href='".$data['url']."/assets/app/favicon-194x194.png'>

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


        </head>

        <body>

        </body>

      </html>

      ");

      //------------------------------------------------------------------------
      //------------------------------------------------------------------------


    }

  }


}




 ?>
