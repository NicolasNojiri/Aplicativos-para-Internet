<?php
spl_autoload_register(function($class){
    // Pasta base do projeto
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

    // Troca \ por / e monta caminho completo
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";

    if(file_exists($file)){
        include $file;
    }
});
