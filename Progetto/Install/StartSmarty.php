<?php

// import the Smarty classes needed by Smarty
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Smarty\Smarty;

class StartSmarty
{
    static function configuration()
    {
        $smarty = new Smarty();  // create a new Smarty object
        $smarty->setTemplateDir('./Progetto/Smarty/templates/'); // set the directory for the templates
        $smarty->setCompileDir('./Progetto/Smarty/templates_c/'); // set the directory for the compiled templates
        $smarty->setCacheDir('/membri/digitalplot/Progetto/Smarty/cache/'); // set the directory for the cache

        $smarty->caching = Smarty::CACHING_LIFETIME_CURRENT;  // it turns on caching

        // it sets the cache lifetime to 3600 seconds (1 hour) which is the default value. 
        // This means that cached templates will be valid for 1 hour before they are regenerated.
        $smarty->cache_lifetime = 3600;

        return $smarty; // return the Smarty object
    }
}
