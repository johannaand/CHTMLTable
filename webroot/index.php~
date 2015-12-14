<?php

require __DIR__.'/config_with_app.php'; 

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN); 


// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di){
            $controller = new \Anax\Users\UsersController();
            $controller->setDI($di);
            return $controller;
        });

$di->set('TableController', function() use ($di){
            $controller = new \Anax\HTMLTable\TableController();
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

$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Hem");
    
    $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
});
 
$app->router->add('redovisning', function() use ($app) {
 
    $app->theme->setTitle("Redovisning");
 
    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
 
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
    
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view-comment',
        'params'    =>  ['redovisning'],
    ]);
 
});

$app->router->add('source', function() use ($app) {
 
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
 
});
 
$app->router->add('comments', function() use ($app) {

    $app->theme->setTitle("Kommentarer");
    $app->theme->addStylesheet('css/comments.css');
    
    $app->views->add('comment/index');

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view-comment',
        'params'    =>  ['comments'],
    ]); 
}); 

$app->router->add('setup', function() use ($app) {
 
    $app->db->setVerbose();
 
    $app->db->dropTableIfExists('user')->execute();
 
    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();
    
        $app->db->insert(
        'user',
        ['acronym', 'email', 'name', 'password', 'created', 'active']
    );
 
    $now = gmdate('Y-m-d H:i:s');
 
    $app->db->execute([
        'admin',
        'admin@dbwebb.se',
        'Administrator',
        crypt('admin'),
        $now,
        $now
    ]);
 
    $app->db->execute([
        'doe',
        'doe@dbwebb.se',
        'John/Jane Doe',
        crypt('doe'),
        $now,
        $now
    ]);
    
    
});

$app->router->add('listall', function() use ($app) {
 
    $app->dispatcher->forward([
      'controller' => 'users',
      'action'    =>  'list',
      ]);
});

$app->router->add('HTMLTable', function() use ($app) {

    $app->theme->setTitle("HTML-tabell");
      
    $noListing = array('password', 'Password', 'pwd');
    
    $app->dispatcher->forward([
        'controller' => 'table',
        'action'     => 'list',
        'params'  => [$noListing, 'Anax\HTMLTable\Movie'],
    ]); 
}); 

    
$app->router->handle();
$app->theme->render();

?>
