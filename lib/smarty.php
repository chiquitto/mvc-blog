<?php

require_once(PATH_LIB . '/smarty/Smarty.class.php');
$smarty = new \Smarty();

$smarty->setTemplateDir(PATH . '/templates');
//$smarty->setConfigDir(PATH . '/templates');

$smarty->setCompileDir(PATH_TMP . '/smarty/templates_c');
$smarty->setCacheDir(PATH_TMP . '/smarty/cache');

$smarty->cache_lifetime = 1;
$smarty->caching = 0;
$smarty->force_compile = true;

$smarty->assign('TITLE', TITLE);

return $smarty;