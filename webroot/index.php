<?php

require __DIR__.'/config_with_app.php'; 

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN); 


// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('TableController', function() use ($di){
            $controller = new \Jovis\HTMLTable\TableController();
            $controller->setDI($di);
            return $controller;
        });

$di->setShared('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
            $db->connect();
            return $db;
        });

$app = new \Anax\Kernel\CAnax($di);
 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');


$app->router->add('HTMLTable', function() use ($app) {

    $app->theme->setTitle("HTML-tabell");
      
    $noListing = array('password', 'Password', 'pwd'); //namn på kolumner vi inte vill ha med i tabellen
                                                      //sin skrivs ut
    
    $app->dispatcher->forward([
        'controller' => 'table',
        'action'     => 'list',
        'params'  => [$noListing, 'Anax\HTMLTable\Movie'],
    ]); 
}); 

    
$app->router->handle();
$app->theme->render();

?>
