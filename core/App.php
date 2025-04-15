<?php

require_once CORE_PATH . '/DB.class.php';

class App
{
    public static function init()
    {
        self::initDatabase();
    }

    private static function initDatabase()
    {
        DB::getInstance();
    }

}

App::init();