<?php

$domains = json_decode(file_get_contents("../domains.json"));
$compiler = 'Listen 443
';
$wsproxys = '';


function renderProxy($proxys, $arrInputProxys)
{
    global $wsproxys;
    foreach ($arrInputProxys as $proxyData) {
        if ($proxys == '') {
            $proxys = $proxys . 'ProxyPreserveHost On
            ';
        }
        $test = explode(":", $proxyData[1]);

        if ($test[0] == "http" || $test[0] == "https") {
            $proxys = $proxys . '
                ProxyPass ' . $proxyData[0] . ' ' . $proxyData[1] . '/
                ProxyPassReverse ' . $proxyData[0] . ' ' . $proxyData[1] . '/
            ';
        }
        if ($test[0] == "ws" || $test[0] == "wss") {
            $wsproxys = $wsproxys . '
                ProxyPass ' . $proxyData[0] . ' ' . $proxyData[1] . '
            ';
        }
    }
    return $proxys;
};

function renderSocketIo($wsHost)
{
    return '
                RewriteEngine On
                RewriteCond %{REQUEST_URI}  ^/socket.io            [NC]
                RewriteCond %{QUERY_STRING} transport=websocket    [NC]
                # RewriteCond %{HTTP:Upgrade} =websocket [NC]
                RewriteRule /(.*)           ' . $wsHost . '/$1 [P,L]
                ';
}

foreach ($domains as $domain) {

    $proxys = '';
    $proxys = renderProxy($proxys, $domain->config_httpd->proxys);

    $headersOrigin = '';
    /*
    if(isset($domain->config_httpd->origins)){
         foreach ($domain->config_httpd->origins as $originUrl) {
                // $headersOrigin = $headersOrigin . '
                // RewriteCond %{REQUEST_URI}  ^/' . $originUrl[0] .'            [NC]
                // RewriteRule ^(.*)$ $1 [E=cors:1]';
              foreach ($originUrl[1] as $originSubUrl) {
                $headersOrigin = $headersOrigin . '
                Header add Access-Control-Allow-Origin "'.$originSubUrl.'"';
              }
            
         }
    }
    $headersOrigin = $headersOrigin . '
    ';
    */
    foreach ($domain->subdomain as $subdomainData) {
        $_proxys = '';
        if (isset($subdomainData->proxys)) {
            $_proxys = renderProxy($_proxys, $subdomainData->proxys);
        }

        if ($domain->config_httpd->ssl == true && $subdomainData->ssl_path != null) {

            $compiler = $compiler . '

            <VirtualHost *:80>
                ServerName ' . $subdomainData->name . $domain->name . '
                Redirect permanent / https://' . ((isset($subdomainData->directory) || isset($subdomainData->proxys)) ? $subdomainData->name . $domain->name : $domain->config_httpd->mainSubdomain . $domain->name) . '/         
            </VirtualHost>

            ' . ($subdomainData->name != $domain->config_httpd->mainSubdomain ? '
            
            <VirtualHost *:443>
                ' . (isset($subdomainData->directory) ?
                'DocumentRoot "' . $subdomainData->directory . '"'
                : '') . ' 
                ServerName ' . $subdomainData->name . $domain->name . '
                ServerAlias ' . $subdomainData->name . $domain->name . '
                SSLEngine On
                SSLCertificateFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/crt.crt"
                SSlCertificateKeyFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/key.key"
                SSLCertificateChainFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/ca_bundle.crt"
                ' . (isset($subdomainData->socket_io) ? renderSocketIo($subdomainData->socket_io) : '') . '
                ' . (isset($subdomainData->directory) ? '
                <Directory "' . $subdomainData->directory . '">
                    Order allow,deny
                    Allow from all
                </Directory>
                ' : (isset($subdomainData->proxys) ? $_proxys : 'Redirect permanent / https://' . $domain->config_httpd->mainSubdomain . $domain->name . '/ ')) . '        
            </VirtualHost>

            ' : '

            <VirtualHost *:443>
            ' . ($domain->config_httpd->directory !== false ? 'DocumentRoot "' . $domain->config_httpd->directory . '"' : '') . '
                ServerName ' . $subdomainData->name . $domain->name . '
                ServerAlias ' . $subdomainData->name . $domain->name . '
                SSLEngine On
                SSLCertificateFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/crt.crt"
                SSlCertificateKeyFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/key.key"
                SSLCertificateChainFile "C:/dd/virtual_machine/SSL/' . $subdomainData->ssl_path . '/ssl/ca_bundle.crt"  
                ' . ($domain->config_httpd->socket_io !== false ? renderSocketIo($domain->config_httpd->socket_io) : '') . '
                ' . ($domain->config_httpd->directory !== false ? '
                <Directory "' . $domain->config_httpd->directory . '">
                    Order allow,deny
                    Allow from all
                </Directory>
                ' : '') . '  
                ' . $headersOrigin . '
                ' . ($_proxys != '' ? $_proxys : $proxys) . '  
            </VirtualHost>
            

            ');
        } else {

            $compiler = $compiler . '

            <VirtualHost *:80>
                ' . ($domain->config_httpd->directory !== false ? 'DocumentRoot "' . $domain->config_httpd->directory . '"' : '') . '
                ServerName ' . $subdomainData->name . $domain->name . '
                ServerAlias ' . $subdomainData->name . $domain->name . '
                ' . ($domain->config_httpd->directory !== false ? '
                <Directory "' . $domain->config_httpd->directory . '">
                    Order allow,deny
                    Allow from all
                </Directory>
                ' : '') . '   
                ' . $headersOrigin . '
                ' . ($_proxys != '' ? $_proxys : $proxys) . '      
            </VirtualHost>

            ';
        }
    }
}

$compiler = $compiler .  $wsproxys;


$file = fopen('./_httpd-ssl.conf', "w");
fwrite($file, $compiler);
fclose($file);
