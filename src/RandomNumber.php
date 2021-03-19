<?php
namespace Src;

class RandomNumber {
    private $requestMethod;
    
    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        if ($this->requestMethod === "GET") {
            $response = $this->getRandomNumber();
        } else {
            $response = $this->requestDenied();
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getRandomNumber()
    {
        $number = rand(1, 100);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('results', $number));
        return $response;
    }

    private function requestDenied()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
