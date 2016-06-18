<?php

require('libs/Emotion.php');
require('libs/ImageUpload.php');
require('models/api_model.php');

class CSave extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_FILES['img'])){
            $image = new ImageUpload($_FILES['img']);
            $image->save();
            $emotion = new Emotion($image->getUrl());
            $result = $emotion->requestEmotion();

            if (!$result['error']) {
                $result['img_name'] = $image->getName();
                $result['img_url'] = urlencode($image->getUrl());
                $result['id'] = $this->generationId();

                if ($this->save($result)) {
                    $this->response->save(200, 'Object saved.', 'save/index');
                } else {
                    $this->response->error(200, "Message don't save. Wrong format data.", 'error/index');
                }
            } else {
                $this->response->error(200, $result, 'error/index');
            }
        } else {
            $this->response->error(400, '400 Bad Request', 'error/index');
        }
    }

    public function generationId()
    {
        $rand = mt_rand(10,99);
        $time = time();

        return $time . $rand;
    }

    public function save($data)
    {
        $model = new Api_Model(DB_EMOTION_COLLECTION);
        return $model->save($data);
    }
}
