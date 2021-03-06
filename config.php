<?php

define('PATH', __DIR__);
define('PATH_LIB', PATH . '/lib');
define('PATH_APP', PATH_LIB . '/app');
define('PATH_TMP', PATH . '/tmp');

define('TITLE', 'Blogcurso 2000');

define('BD_HOST', 'localhost');
define('BD_USUARIO', 'root');
define('BD_SENHA', '001001');
define('BD_NOME', 'blog');

define('DATE_BD', 'Y-m-d');
define('DATE_USUARIO', 'd/m/Y');

define('CATEGORIA_INATIVO', '0');
define('CATEGORIA_ATIVO', '1');

define('POSTAGEM_INATIVO', '0');
define('POSTAGEM_ATIVO', '1');

// autoload
require PATH_LIB . '/psr4.php';
$loader = new \App\Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('App', PATH_APP);
// $loader->addNamespace('App\Controller', PATH_APP . '/Controller');
// $loader->addNamespace('App\Dao', PATH_APP . '/Dao');
// $loader->addNamespace('App\Vo', PATH_APP . '/Vo');

require PATH_LIB . '/funcoes.php';
require PATH_APP . '/Conexao.php';
