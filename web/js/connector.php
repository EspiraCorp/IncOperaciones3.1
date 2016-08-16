<?php

        //var_dump(dirname($_SERVER['PHP_SELF'])."/../../");

$path = pathinfo(__FILE__);

$opts = array(
    'locale' => '',
    'roots'  => array(
        array(
            'driver' => 'LocalFileSystem',
            'path'   => $path['dirname']. '/../bundles/CatalogoBundle/Archivos/',
            'URL'    => $path['dirname']. '/../bundles/CatalogoBundle/Archivos/',
        )
    )
);
//print_r(pathinfo(__FILE__));

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();
