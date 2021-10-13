<?php

namespace Epayco\Colas;

//require 'vendor/autoload.php';

class Colas
{

    private $public_key = null;
    private $private_key = null;
    public $base_url;
    public $token = "";

    public function __construct($public_key, $private_key)
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
        $this->getUrlSeth();
    }

    public function login()
    {

        // Now let's make a request!
        try {
            $path_login = '/login';

            $options = array(
                'auth' => array($this->public_key, $this->private_key),
                'timeout' => 30,
                'connect_timeout' => 30,
            );

            $request = \Requests::post($this->base_url . $path_login, array(), array(), $options);
            $response = json_decode($request->body);
            $this->token = $response->token;
            return $response;

        } catch (Exception $ex) {

            $obj = new \stdClass();
            $obj->token == "";
            return $obj;
        }


    }

    public function addMessage($cola, $action, $message)
    {

        if ($this->token == "") {
            $this->login();
        }
        try {
            $headers = array('Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $this->token);
            $options = array(
                'timeout' => 30,
                'connect_timeout' => 30,
            );
            $path_action = "/add/queue/$cola";
            $data = array('action' => $action, 'message' => $message);

            $post_data = json_encode($data);

            $request = \Requests::post($this->base_url . $path_action, $headers, $data, $options);
            $response = json_decode($request->body);

            return $response;

        } catch (\Exception $ex) {
            return false;
        }

    }

    private function getUrlSeth()
    {
        $environment = getenv("APP_SETH_ENVIRONMENT");
        switch ($environment) {
            case "test";
                $this->base_url = "https://seth.epayco.xyz";
                break;
            case "dev";
                $this->base_url = "https://seth.epayco.io";
                break;
            default;
                $this->base_url = "https://seth.epayco.co";
        }
    }

}
