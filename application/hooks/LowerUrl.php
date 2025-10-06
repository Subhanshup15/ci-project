<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LowerUrl {
    
    public function run() {
    
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

         
            $_SERVER['REQUEST_URI'] = ucfirst($uri_segments[0]).'/'.implode(array_shift($uri_segments),'/');
    }
}