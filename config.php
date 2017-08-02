<?php

define('PATH', __DIR__);
define('PATH_LIB', PATH . '/lib');
define('PATH_APP', PATH_LIB . '/app');
define('PATH_TMP', PATH . '/tmp');

define('TITLE', 'Blogcurso 2000');

define('BD_HOST', 'localhost');
define('BD_USUARIO', 'root');
define('BD_SENHA', 'vagrant');
define('BD_NOME', 'blog');

define('CATEGORIA_INATIVO', '0');
define('CATEGORIA_ATIVO', '1');

define('POSTAGEM_INATIVO', '0');
define('POSTAGEM_ATIVO', '1');

require PATH_LIB . '/funcoes.php';
require PATH_APP . '/Conexao.php';
