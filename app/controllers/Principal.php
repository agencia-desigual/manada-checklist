<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/03/2019
 * Time: 18:29
 */

namespace Controller;

use Helper\Apoio;
use Model\Categoria;
use Model\Cliente;
use Model\Equipamento;
use Model\Funcionario;
use Model\Projeto;
use Model\Usuario;
use Sistema\Controller as CI_controller;


class Principal extends CI_controller
{

    private $objHelperApoio;
    private $objModelUsuario;
    private $objModelFuncionarios;
    private $objModelClientes;
    private $objModelEquipamentos;
    private $objModelProjetos;
    private $objModelCategoria;

    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();

        $this->objHelperApoio = new Apoio();
        $this->objModelUsuario = new Usuario();
        $this->objModelFuncionarios = new Funcionario();
        $this->objModelClientes = new Cliente();
        $this->objModelEquipamentos = new Equipamento();
        $this->objModelProjetos = new Projeto();
        $this->objModelCategoria = new Categoria();
    }

    /**
     * Método responsável por carregar a view da dashboard
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function dashboard()
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



        // CONTADORES =========================================================

        $qtdeFuncionarios = $this->objModelFuncionarios->get()->rowCount();
        $qtdeUsuarios = $this->objModelUsuario->get()->rowCount();
        $qtdeProjetos = $this->objModelProjetos->get()->rowCount();
        $qtdeEquipamentos = $this->objModelEquipamentos->get()->rowCount();

        // FIM CONTADORES =====================================================



        // LISTAS =========================================================

        $equipamentos = $this->objModelEquipamentos->get(null,"id_equipamento DESC","0,4",null)->fetchAll(\PDO::FETCH_OBJ);
        foreach ($equipamentos as $equipamento)
        {
            // Configurando imagem de perfil
            $equipamento->perfil =  $this->objHelperApoio->configuraImagem($equipamento);

            //Pegando o nome da categoria
            $buscaCategoria = $this->objModelCategoria->get(["id_categoria" => $equipamento->id_categoria])->fetch(\PDO::FETCH_OBJ);
            $equipamento->categoria_nome = $buscaCategoria->nome;
        }


        $projetos = $this->objModelProjetos->get(null,"id_projeto DESC",null,null)->fetch(\PDO::FETCH_OBJ);

        // Usuário responsavel
        $buscaUsuario = $this->objModelUsuario->get(['id_usuario' => $projetos->id_usuario])->fetch(\PDO::FETCH_OBJ);
        $projetos->nome_usuario = $buscaUsuario->nome;

        // Cliente responsavel
        $buscaCliente = $this->objModelClientes->get(['id_cliente' => $projetos->id_cliente])->fetch(\PDO::FETCH_OBJ);
        $projetos->nome_cliente = $buscaCliente->nome;

        // Data
        $projetos->data_ida = date("d/m/Y", strtotime($projetos->data_ida));
        $projetos->data_volta = date("d/m/Y", strtotime($projetos->data_volta));
        $projetos->horario = date("H:i", strtotime($projetos->horario));

//        $this->debug($projetos);


        // FIM LISTAS =====================================================



        $dados = [
            "qtdeFuncionarios" => $qtdeFuncionarios,
            "qtdeUsuarios" => $qtdeUsuarios,
            "qtdeEquipamentos" => $qtdeEquipamentos,
            "qtdeProjetos" => $qtdeProjetos,
            "equipamentos" => $equipamentos,
            "projeto" => $projetos,
            "usuario" => $usuario
        ];

        $this->view("painel/dashboard",$dados);
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

        // Buscando todos os usuarios
        $usuarios = $this->objModelUsuario->get(null,"id_usuario DESC", null, null, null)->fetchAll(\PDO::FETCH_OBJ);
        foreach ($usuarios as $user)
        {
            $user->perfil = $this->objHelperApoio->configuraImagem($user);
        }

        $dados = [
            "usuario" => $usuario,
            "usuarios" => $usuarios,
            "js" => [
                "pages" => ["datatables"],
                "modulos" => ["Usuario"]
            ]
        ];

        $this->view("painel/usuarios/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de adicionar
     * um usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function usuarioAdicionar()
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

        // Buscando todos os usuarios
        $usuarios = $this->objModelUsuario->get(null,"id_usuario DESC")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($usuarios as $user)
        {
            $user->perfil = $this->objHelperApoio->configuraImagem($user);
        }

        $dados = [
            "usuario" => $usuario,
            "usuarios" => $usuarios,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Usuario"]
            ]
        ];

        $this->view("painel/usuarios/adicionar",$dados);
    }



    /**
     * Método responsável por carregar a view de editar
     * um usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function usuarioEditar($id)
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

        // Buscando o usuario selecionado
        $usuarios = $this->objModelUsuario->get(["id_usuario" => $id])->fetch(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "usuarios" => $usuarios,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Usuario"]
            ]
        ];

        $this->view("painel/usuarios/editar",$dados);
    }



    /**
     * Método responsável por carregar a view de lista dos
     * funcionarios
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function funcionarios()
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

        $this->view("painel/funcionarios/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de lista dos
     * empresas
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function empresas()
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

        $this->view("painel/empresas/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de lista dos
     * equipamentos
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function equipamentos()
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

        $this->view("painel/equipamentos/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de lista dos
     * projetos
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function projetos()
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

        $this->view("painel/projetos/listar",$dados);
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