<?php

    //error_reporting( 0 );
    error_reporting( E_ALL );

    define( 'SITE_DOC_ROOT', dirname( dirname( __FILE__ ) ) );
    define( 'LIB_PATH', dirname( __FILE__ ) );

    require_once( LIB_PATH . '/smarty/Smarty.class.php');

    $smarty = new Smarty();
    $smarty->setTemplateDir( SITE_DOC_ROOT . '/htdocs/templates/' );
    $smarty->setCompileDir( SITE_DOC_ROOT . '/cache/smarty/compdir' );
    $smarty->setCacheDir( SITE_DOC_ROOT . '/cache/smarty/cachedir' );

    $smarty->assign( 'TSidemenu', 1 );
    $smarty->assign( 'TFeDebug', 1 );
    $smarty->assign( 'TMODE', 0 );
    $smarty->assign( 'TPUBLIC', 0 );

    $smarty->left_delimiter = "{{"; 
    $smarty->right_delimiter = "}}"; 

    $smarty->auto_literal = false;

    //$smarty->display( $file );
?>

