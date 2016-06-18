<?php

require('models/api_model.php');

class CContent extends Controller
{
    public $model;

    public function index()
    {
        $this->model = new Api_Model(DB_CONTENT_COLLECTION);

        $result = $this->model->getAll();

        if ($result) {
            $this->response->roster(200, 'ok', 'get/index', $result);
        } else {
            $this->response->error(404, 'Not Found', 'error/index');
        }
    }
}
