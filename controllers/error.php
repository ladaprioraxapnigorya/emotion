<?php

class CError extends Controller
{
    public function index()
    {
        $this->response->error(404, 'Not found', 'error/index');
    }
}
