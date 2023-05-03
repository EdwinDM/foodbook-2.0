<?php 
    namespace Medoo;
    require 'Medoo.php';

    if(!isset($database)){
        $database = new Medoo([
            // [required]
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'recipes',
            'username' => 'root',
            'password' => '' 
        ]);
    }
?>