<?php

namespace Controller\Api;


use Helper\Apoio;
use Sistema\Controller as CI_controller;

class Usuario extends CI_controller
{
    private $objSeguranca;
    private $objHelperApoio;

    public function __construct()
    {
        parent::__construct();
        $this->objHelperApoio = new Apoio();
    }

    public function login()
    {
        
    }

    public function seguranca()
    {
        // Verificando se o usuario está logado
        if(empty($_SESSION['usuario']))
        {
            // Acesso negado
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            die("Not authorized");
        }
    }

}