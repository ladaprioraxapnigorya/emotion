<?php

class Db
{
    public static function createDbConnect()
    {
        return new \MongoDB\Driver\Manager(DB_TYPE . '://' . DB_HOST . ':' . DB_PORT);
    }
}
