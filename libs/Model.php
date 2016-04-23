<?php

class Model
{
    private $db;
    private $collection;
    protected $connect;

    function __construct($collection)
    {
        $this->db         = DB_NAME;
        $this->collection = $collection;
        $this->connect = Db::createDbConnect();

        return $this->connect;
    }

    public function getDbName()
    {
        return $this->db;
    }

    public function getCollectionName()
    {
        return $this->collection;
    }

    public function getNamespace()
    {
        return $this->db . '.' . $this->collection;
    }

    public function fetchQuery($query = [])
    {
        return new MongoDB\Driver\Query($query);
    }

    public function fetchBulk()
    {
        return new MongoDB\Driver\BulkWrite();
    }
}
