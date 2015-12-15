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
 
$app->theme->configure(ANAX_APP_PATH . 'config/theme.php');

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar.php');


$app->router->add('HTMLTable', function() use ($app) {

    $app->theme->setTitle("HTML-tabell");
      
    $model = new Jovis\DatabaseModel\Movie();  // modellen man vill skriva ut som html-tabell                                                                                                     
      
    
    $app->dispatcher->forward([ //används bara för att skapa tabell och befolka databasen, för test
        'controller' => 'table',
        'action'     => 'init',
        'params'    => [$model],
    ]);
   
    $noListing = array('password', 'Password', 'pwd'); //namn på kolumner vi inte vill ha med i tabellen
                                                      //sin skrivs ut

    
    
    $app->dispatcher->forward([
        'controller' => 'table',
        'action'     => 'list',
        'params'  => [$noListing, $model], //skickar med objektet som ska skrivas ut
    ]); 
}); 

    
$app->router->handle();
$app->theme->render();

?>
