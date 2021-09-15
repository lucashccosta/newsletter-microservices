<?php

namespace Libs\Core;

class Request
{
    const HTTP_CONTENT_TYPE = 'application/json';

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function url()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function body()
    {
        $data = [];
        if (!$this->isJson()) {
            if ($this->isGet()) {
                foreach ($_GET as $key => $value) {
                    $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            if ($this->isPost()) {
                foreach ($_POST as $key => $value) {
                    $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        } else {
            $data = json_decode(file_get_contents('php://input'), true);
        }
        
        return $data;
    }

    protected function isGet()
    {
        return $this->method() === 'get';
    }

    protected function isPost()
    {
        return $this->method() === 'post';
    }

    protected function isJson()
    {
        return ($_SERVER['CONTENT_TYPE'] === self::HTTP_CONTENT_TYPE);
    }
}
