<?php

class Response
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
        $this->setHeaders('Content-Type', 'application/json');
    }

    private function setHeaders($header, $value)
    {
        header($header . ':' . $value);
    }

    public function save($status, $message, $view)
    {
        $this->view->response = json_encode([
            'status' => $status,
            'message' => $message,
        ]);
        $this->setHttpResponseCode($status);
        $this->responseRender($view);
    }

    private function setHttpResponseCode($status)
    {
        http_response_code($status);
    }

    private function responseRender($view)
    {
        $this->view->render($view);
    }

    public function get($status, $message, $view, array $items)
    {
        $this->view->response = json_encode([
            'status' => $status,
            'message' => $message,
            'result' => $items,
        ]);
        $this->setHttpResponseCode($status);
        $this->responseRender($view);
    }

    public function roster($status, $message, $view, array $items)
    {
        $this->view->response = json_encode([
            'status' => $status,
            'message' => $message,
            'result' => [
                'total' => count($items),
                'items' => $items,
            ]
        ]);
        $this->setHttpResponseCode($status);
        $this->responseRender($view);
    }

    public function error($status, $message, $view)
    {
        $this->view->response = json_encode([
            'status' => $status,
            'message' => $message,
        ]);
        $this->setHttpResponseCode($status);
        $this->responseRender($view);
    }
}
