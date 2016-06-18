<?php

require('models/api_model.php');

/**
 * @SWG\Get(
 *     path="/api/resource.json",
 *     @SWG\Response(response="200", description="An example resource")
 * )
 */
class CGet extends Controller
{
    public function index()
    {
        if ($_GET['id']){
            $id = $_GET['id'];
            $this->model = new Api_Model();
            $result = $this->model->getById($id);

            if ($result) {
                $this->response->get(200, 'ok', 'get/index', $result);
            } else {
                $this->response->error(404, 'Not fount', 'error/index');
            }
        } else {
            $this->response->error(400, 'Bad Request', 'error/index');
        }
    }
}
