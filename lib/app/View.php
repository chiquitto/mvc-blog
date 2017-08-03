<?php
namespace App;


class View
{
    /**
     * @var \Smarty
     */
    private static $instance;

    /**
     * @return \Smarty
     */
    public static function getView() {
        if (static::$instance === null) {
            static::$instance = require (PATH_LIB . '/smarty.php');
        }

        return static::$instance;
    }
}