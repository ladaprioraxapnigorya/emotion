<?php

require_once 'HTTP/Request2.php';

class Emotion
{
    protected $data;
    protected $emotion;
    protected $headers = [
        'Content-Type' => 'application/json',
        'Ocp-Apim-Subscription-Key' => '7f3bc9352a584d06b3f681a5d2b93112',
    ];

    public function __construct($data)
    {
        $this->emotion = new HTTP_Request2(EMOTION_URL);
        $this->data = json_decode('{"url": " ' . $data . ' "}');
    }

    public function requestEmotion()
    {
        $this->emotion->setHeader($this->headers);
        $this->emotion->setMethod(HTTP_Request2::METHOD_POST);
        $this->emotion->setBody(json_encode($this->data));

        try
        {
            $response = $this->emotion->send();
            return json_decode($response->getBody(), true);
        }
        catch (HttpException $ex)
        {
            return $ex;
        }
    }
}
