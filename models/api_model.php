<?php

class Api_Model extends Model
{
    public function save($data)
    {
        $strJson = json_encode($data);
        $bulk = $this->fetchBulk();
        $bulk->insert(json_decode($strJson));
        return $this->connect->executeBulkWrite($this->getNamespace(), $bulk);
    }

    public function getAll()
    {
        $result = [];
        $rows = $this->connect->executeQuery($this->getNamespace(), $this->fetchQuery());

        foreach ($rows as $obj) {
            $obj->img_url = urldecode($obj->img_url);
            unset($obj->_id);
            $result[] = (array)$obj;
        }

        return $result;
    }
}
