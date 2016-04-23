<?php

class ImageUpload
{
    private $handle;
    private $name;
    private $type;
    private $tmp_url;
    private $url;
    private $error;
    private $size;

    public function __construct(array $image)
    {
        $this->name    = $image['name'];
        $this->type    = $image['type'];
        $this->error   = $image['error'];
        $this->size    = $image['size'];
        $this->tmp_url = $image['tmp_name'];
        $this->handle  = fopen($this->tmp_url, 'rb');
    }

    public function getStream()
    {
        return $this->handle;
    }

    public function close()
    {
        return fclose($this->handle);
    }

    public function save($path = __DIR__ . '\..\image\\')
    {
        $this->url = $path . $this->name;

        move_uploaded_file($this->tmp_url, $path . $this->name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return 'http://s38-temporary-files.radikal.ru/147421baf5e94bdfa3cb830a6a61dbec/-88693455.jpg';
    }
}
