<?php 

require "vendor/autoload.php";
use Michelf\Markdown;

$loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__) . '/views');

$twigConfig = array(
    // 'cache' => './cache/twig/',
    // 'cache' => false,
    'debug' => true,
);

Flight::register('view', '\Twig\Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new \Twig\Extension\DebugExtension()); // Add the debug extension
    
    $twig->addFilter(new \Twig\TwigFilter('markdown', function($string){
        return Markdown::defaultTransform($string);
    }));
});

Flight::map('render', function($template, $data=array()){
    Flight::view()->display($template, $data);
});



Flight::route('/', function(){
    $data = array(
        '' => get_zerg(),
    );
    
    Flight::render('index.twig', $data);
});

Flight::route('/', function(){
    $data = array(
        '' => get_terran(),
    );
    
    Flight::render('index.twig', $data);
});

Flight::route('/zerg/@slug', function($slug){
    $data = array(
        'perso' => get_zergunits_by_slug($slug),
        'top_rated_zerg' => get_top_rated_zerg(),
    );

    Flight::render('starcraft.twig', $data);
});
Flight::route('/terran/@slug', function($slug){
    $data = array(
        'perso' => get_terranunits_by_slug($slug),
        'top_rated_terran' => get_top_rated_terran(),
    );

    Flight::render('starcraft.twig', $data);
});


Flight::start();