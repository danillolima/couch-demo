<?php

require 'vendor/autoload.php';

class HTTPHandler{
    private $client = null;
    const url = 'http://admin:root@127.0.0.1:5984/';
    public function __contruct(){
        $this->client = new GuzzleHttp\Client( 
            ['base_uri' => url]
        );
    }
}