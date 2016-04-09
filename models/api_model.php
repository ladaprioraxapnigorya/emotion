<?php

class Api_Model extends Model
{
    public function save($data)
    {
        $strJson = json_encode($data);

        return $this->db->query("INSERT INTO emotion (json_data) VALUES ('$strJson')");
    }

    public function getAll()
    {
        $result = [];
        $emotions = $this->db->query("SELECT * FROM emotion")->fetchAll();

        foreach ($emotions as $emotion) {
            $arrEmotion = json_decode($emotion['json_data']);
            $arrEmotion->img_url = urldecode($arrEmotion->img_url);
            $result[] = $arrEmotion;
        }

        return $result;
    }
}
