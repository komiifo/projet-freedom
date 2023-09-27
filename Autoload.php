<?php

/**
 * Autoload Classes
 */
const CLASSES_SOURCES = [
    'public',
    'public/assets',
    'public/assets/css',
    'public/controllers',
    'public/models',
    'public/views',
    
	

];

function autoloadClass( $class ) {

    $sources = array_map( function($folder) use($class) {

        return __DIR__ . '/' . $folder . '/' . $class . '.php';

    }, CLASSES_SOURCES );

    foreach($sources as $s) {

        if (file_exists( $s ) ) {
            require_once ($s);
        }
    }


}

spl_autoload_register( 'autoloadClass' );

?>