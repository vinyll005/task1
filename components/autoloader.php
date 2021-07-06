<?php
    spl_autoload_register(function($className)    {
        
        $folders = array(
            '/Models/',
            '/Components/',
            '/Controllers/'
        );

        foreach($folders as $folder)    {
            $file = ROOT.$folder.$className.'.php';
            if(file_exists($file))  {
                include_once($file);
            }
        }
    });
?>
