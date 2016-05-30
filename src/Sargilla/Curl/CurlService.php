<?php 

namespace Sargilla\Curl;

class CurlService {

    /**
     * @param $url string   The URL to which the request is to be sent
     * @return \Sargilla\Curl\Curl
     */
    public function to($url)
    {
        return new Curl($url);
    }

}