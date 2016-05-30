<?php 

namespace Sargilla\Curl;

/**
 * Curl
 */
class Curl
{
    protected $useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7'; 
    protected $url; 
    protected $followlocation; 
    protected $timeout; 
    protected $maxRedirects; 
    protected $cookieFileLocation = '.\cookie.txt'; 
    protected $post; 
    protected $postFields; 
    protected $referer =""; 
    protected $session; 
    protected $webpage; 
    protected $headers; 
    protected $header_out;
    protected $includeHeader; 
    protected $noBody; 
    protected $status; 
    protected $binaryTransfer; 
    protected $user_options; 
    public    $authentication = 0; 
    public    $auth_name      = ''; 
    public    $auth_pass      = ''; 
    
    public function useAuth($use)
    { 
        $this->authentication = 0; 
       if($use == true) $this->authentication = 1; 
    } 

    public function setName($name){ 
        $this->auth_name = $name; 
    } 
    public function setPass($pass){ 
        $this->auth_pass = $pass; 
    } 

    public function __construct($url = '', $options = array()) 
    { 
        $this->url = $url; 
        $this->followlocation = false; 
        $this->timeout = 30; 
        $this->maxRedirects = 3; 
        $this->noBody = false; 
        $this->includeHeader = false; 
        $this->header_out = true;
        $this->binaryTransfer = false; 
        $this->headers = ['Accept: */*', 'Connection: Keep-Alive'];
        $this->cookieFileLocation = public_path() . '\cookies.txt';
        $this->user_options = $options; 
    } 
    public function setUrl($url)
    { 
        $this->url = $url; 
    } 
    public function setReferer($referer)
    { 
        $this->referer = $referer; 
    } 
    public function setHeader($header)
    { 
        $this->headers[] = $header; 
    } 
    public function includeHeader($bolean = true)
    { 
        $this->includeHeader = $bolean; 
    } 

    public function setCookieFileLocation($path) 
    { 
        $this->cookieFileLocation = $path; 
    } 

    public function setPost ($postFields) 
    {   
        if(is_array($postFields)){
            $postFields = http_build_query($postFields); 
        };    
        $this->post = true; 
        $this->postFields = $postFields; 
    } 

    public function setUserAgent($userAgent) 
    { 
        $this->useragent = $userAgent; 
    } 
    public function createCurl($url = 'null') 
    { 
        if($url != 'null'){ 
            $this->url = $url; 
        } 

        $s = curl_init(); 

        curl_setopt($s,CURLOPT_URL,$this->url); 
        curl_setopt($s,CURLOPT_HTTPHEADER,$this->headers); 
        curl_setopt($s,CURLOPT_TIMEOUT,$this->timeout); 
        curl_setopt($s,CURLOPT_MAXREDIRS,$this->maxRedirects); 
        curl_setopt($s,CURLOPT_RETURNTRANSFER,true); 
        curl_setopt($s,CURLOPT_FOLLOWLOCATION,$this->followlocation); 
        curl_setopt($s,CURLOPT_COOKIEJAR,$this->cookieFileLocation); 
        curl_setopt($s,CURLOPT_COOKIEFILE,$this->cookieFileLocation); 
        curl_setopt($s, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($s, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($s,CURLINFO_HEADER_OUT,  $this->header_out);
        curl_setopt($s, CURLOPT_FILETIME, 1);

        if($this->authentication == 1){ 
            curl_setopt($s, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass); 
        } 
        if($this->post) 
        { 
            curl_setopt($s,CURLOPT_POST,true); 
            curl_setopt($s,CURLOPT_POSTFIELDS,$this->postFields); 
        } 

        if($this->includeHeader) 
        { 
            curl_setopt($s,CURLOPT_HEADER,true); 
        } 

        if($this->noBody) 
        { 
            curl_setopt($s,CURLOPT_NOBODY,true); 
        } 
        /* 
        if($this->_binary) 
        { 
            curl_setopt($s,CURLOPT_BINARYTRANSFER,true); 
        } 
        */ 
        curl_setopt($s,CURLOPT_USERAGENT,$this->useragent); 
        curl_setopt($s,CURLOPT_REFERER,$this->referer); 
        curl_setopt_array($s,$this->user_options);
        $this->webpage = curl_exec($s); 
        $this->status = curl_getinfo($s); 
        $this->session = $s;
        
    }
    public function closeCurl()
    {
        curl_close($this->session);
    }
    public function getHttpStatus() 
    { 
        return $this->status; 
    } 
    public function getResponse(){ 
        return $this->webpage; 
    } 

    public function __tostring(){ 
        return $this->webpage; 
    } 
}