<?php
trait Model_Singleton
{
    public static function getInstance()
    {
        static $instance;
        if (is_null($instance)){
            $instance = new static;
        }
        return $instance;
    }
}