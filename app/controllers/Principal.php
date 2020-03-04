<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/03/2019
 * Time: 18:29
 */

namespace Controller;

use Helper\Apoio;
use Model\Usuario;
use Sistema\Controller as CI_controller;


class Principal extends CI_controller
{

    private $objHelperApoio;
    private $objModelUsuario;

    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();

        $this->objHelperApoio = new Apoio();
        $this->objModelUsuario = new Usuario();
    }

    /**
     * Método responsável por carregar a view da dashboard
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function index()
    {
        // Redirecionamento Login
        $this->verificaLogin();

        // Pegando o email do usuario
        $email = $_SESSION['usuario'];

        // Buscando o usuario por email
        $usuario = $this->objModelUsuario->get(["email" => $email])->fetch(\PDO::FETCH_OBJ);
        $perfil = $this->objHelperApoio->configuraImagem($usuario);
        //Pegando o link da img
        $usuario->perfil = $perfil;

        $dados = [
            "usuario" => $usuario
        ];

        $this->view("painel/index",$dados);
    }



    /**
     * Método responsável por carregar a view de lista dos
     * usuarios
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function usuarios()
    {
        // Redirecionamento Login
        $this->verificaLogin();

        // Pegando o email do usuario
        $email = $_SESSION['usuario'];

        // Buscando o usuario por email
        $usuario = $this->objModelUsuario->get(["email" => $email])->fetch(\PDO::FETCH_OBJ);
        $perfil = $this->objHelperApoio->configuraImagem($usuario);
        //Pegando o link da img
        $usuario->perfil = $perfil;

        $dados = [
            "usuario" => $usuario
        ];

        $this->view("usuario/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de login
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function login()
    {

        $dados = [
            "js" => [
                "modulos" => ["Login"]
            ]
        ];

        // Carregando a view
        $this->view("login",$dados);
    }



    /**
     * Método responsável por repver a sessão do usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function sair()
    {
        //Verificando o usuario
        if(isset($_SESSION['usuario']))
        {
            unset($_SESSION['usuario']);
            // Redirecionando
            header('Location: '.BASE_URL.'login');
        }

    }


    /**
     * Método responsável por verificar se existe
     * algum usuario logado, se não tiver ele redireciona
     * para a pagina de login
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function verificaLogin()
    {
        //Verificando o usuario
        if(!isset($_SESSION['usuario']))
        {
            // Redirecionando
            header('Location: '.BASE_URL.'login');
        }
    }


} // END::Class Principal