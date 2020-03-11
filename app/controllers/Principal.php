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
use Model\ProjetoEquipamento;
use Model\ProjetoFuncionario;
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
    private $objProjetoEquipamento;

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
        $this->objProjetoEquipamento = new ProjetoEquipamento();
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

        // Variaveis
        $buscaUsuario = null;
        $buscaCliente = null;
        $buscaCategoria = null;

        // Pegando o email do usuario
        $email = $_SESSION['usuario'];

        // Buscando o usuario por email
        $usuario = $this->objModelUsuario->get(["email" => $email])->fetch(\PDO::FETCH_OBJ);
        $usuario->perfil = $this->objHelperApoio->configuraImagem($usuario);


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

        if(!empty($projetos))
        {
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
        }


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

        $funcionarios = $this->objModelFuncionarios->get(null,"id_funcionario DESC")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($funcionarios as $funcionario)
        {
            $funcionario->perfil = $this->objHelperApoio->configuraImagem($funcionario);
        }

        $dados = [
            "usuario" => $usuario,
            "funcionarios" => $funcionarios,
            "js" => [
                "pages" => ["datatables"],
                "modulos" => ["Funcionario"]
            ]
        ];

        $this->view("painel/funcionarios/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de adicionar
     * um funcionario
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function funcionarioAdicionar()
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
            "usuario" => $usuario,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Funcionario"]
            ]
        ];

        $this->view("painel/funcionarios/adicionar",$dados);
    }



    /**
     * Método responsável por carregar a view de editar
     * um usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function funcionarioEditar($id)
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
        $funcionario = $this->objModelFuncionarios->get(["id_funcionario" => $id])->fetch(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "funcionario" => $funcionario,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Funcionario"]
            ]
        ];

        $this->view("painel/funcionarios/editar",$dados);
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

        $empresas = $this->objModelClientes->get()->fetchAll(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "empresas" => $empresas,
            "js" => [
                "pages" => ["datatables"],
                "modulos" => ["Empresa"]
            ]
        ];

        $this->view("painel/empresas/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de adicionar
     * uma empresa
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function empresaAdicionar()
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
            "usuario" => $usuario,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Empresa"]
            ]
        ];

        $this->view("painel/empresas/adicionar",$dados);
    }



    /**
     * Método responsável por carregar a view de editar
     * uma empresa
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function empresaEditar($id)
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
        $empresa = $this->objModelClientes->get(["id_cliente" => $id])->fetch(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "empresa" => $empresa,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Empresa"]
            ]
        ];

        $this->view("painel/empresas/editar",$dados);
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

        $equipamentos = $this->objModelEquipamentos->get()->fetchAll(\PDO::FETCH_OBJ);
        foreach ($equipamentos as $equipamento)
        {
            $buscaCategoria = $this->objModelCategoria->get(["id_categoria" => $equipamento->id_categoria])->fetch(\PDO::FETCH_OBJ);
            $equipamento->categoria = $buscaCategoria->nome;

            //Pegando o link da imagem
            $equipamento->perfil = $this->objHelperApoio->configuraImagem($equipamento);
        }

        $dados = [
            "usuario" => $usuario,
            "equipamentos" => $equipamentos,
            "js" => [
                "pages" => ["datatables"],
                "modulos" => ["Equipamento"]
            ]
        ];

        $this->view("painel/equipamentos/listar",$dados);
    }



    /**
     * Método responsável por carregar a view de adicionar
     * um equipamento
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function equipamentoAdicionar()
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

        $categorias = $this->objModelCategoria->get()->fetchAll(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "categorias" => $categorias,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Equipamento"]
            ]
        ];

        $this->view("painel/equipamentos/adicionar",$dados);
    }



    /**
     * Método responsável por carregar a view de editar
     * um equipamento
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function equipamentoEditar($id)
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
        $equipamento = $this->objModelEquipamentos->get(["id_equipamento" => $id])->fetch(\PDO::FETCH_OBJ);

        $buscaCategoria = $this->objModelCategoria->get(["id_categoria" => $equipamento->id_categoria])->fetch(\PDO::FETCH_OBJ);
        $equipamento->nome_categoria = $buscaCategoria->nome;

        // Buscando todas as categorias
        $categorias = $this->objModelCategoria->get()->fetchAll(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "equipamento" => $equipamento,
            "categorias" => $categorias,
            "js" => [
                "pages" => ["dropfy"],
                "modulos" => ["Equipamento"]
            ]
        ];

        $this->view("painel/equipamentos/editar",$dados);
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

        // Buscando todos projetos
        $projetos = $this->objModelProjetos->get()->fetchAll(\PDO::FETCH_OBJ);

        foreach ($projetos as $projeto)
        {
            // Buscando o cliente
            $buscaCliente = $this->objModelClientes->get(["id_cliente" => $projeto->id_cliente])->fetch(\PDO::FETCH_OBJ);
            $projeto->nome_cliente = $buscaCliente->nome;

            // Buscando o responsavél
            $buscaUsuario = $this->objModelUsuario->get(["id_usuario" => $projeto->id_usuario])->fetch(\PDO::FETCH_OBJ);
            $projeto->responsavel = $buscaUsuario->nome;

            if($projeto->data_volta > date("Y-m-d"))
            {
                $projeto->status = true;
            }
            else
            {
                $projeto->status = false;
            }

            // Padrão de data e hora
            $projeto->data_ida = date("d/m/Y", strtotime($projeto->data_ida));
            $projeto->data_volta = date("d/m/Y", strtotime($projeto->data_volta));
            $projeto->horario = date("H:i", strtotime($projeto->horario));
        }

        $dados = [
            "usuario" => $usuario,
            "projetos" => $projetos,
            "js" => [
                "pages" => ["datatables"],
                "modulos" => ["Projeto"]
            ]
        ];

        $this->view("painel/projetos/listar",$dados);
    }





    /**
     * Método responsável por carregar a view de adicionar
     * um projeto
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function projetoAdicionar()
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
        $cont = 0;

        // Buscando todos os clientes
        $clientes = $this->objModelClientes->get()->fetchAll(\PDO::FETCH_OBJ);

        // Buscando todos os equipamentos
        $equipamentos = $this->objModelEquipamentos
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);


        foreach ($equipamentos as $equipamento)
        {
            $buscaCategoria = $this->objModelCategoria->get(['id_categoria' => $equipamento->id_categoria])->fetch(\PDO::FETCH_OBJ);
            $equipamento->nome_categoria = $buscaCategoria->nome;

            // Buscando o equipamento em outros projetos
            $equipamentoProjetos = $this->objProjetoEquipamento
                ->get(["id_equipamento" => $equipamento->id_equipamento])
                ->fetch(\PDO::FETCH_OBJ);

            // Verificando se achou o equipamento
            if(!empty($equipamentoProjetos)) {

                // Buscando o projeto
                $buscaProjeto = $this->objModelProjetos
                    ->get(['id_projeto' => $equipamentoProjetos->id_projeto])
                    ->fetch(\PDO::FETCH_OBJ);


                // Verifica se o projeto está ativo
                if ($buscaProjeto->data_volta > date("Y-m-d"))
                {

                    // Verificando se é o mesmo equipamento para fazer a subtração
                    if ($equipamento->id_equipamento == $equipamentoProjetos->id_equipamento) {
                        $equipamento->quantidade -= $equipamentoProjetos->quantidade;

                        // Caso zerar a quantidade do equipamento, remove ele da lista
                        if ($equipamento->quantidade <= 0) {
                            unset($equipamentos[$cont]);
                        }

                    }

                }
            }

            $cont++;
        }

        // Buscando todos os funcionarios
        $funcionarios = $this->objModelFuncionarios->get(["status" => true])->fetchAll(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "equipamentos" => $equipamentos,
            "funcionarios" => $funcionarios,
            "clientes" => $clientes,
            "js" => [
                "modulos" => ["Projeto"]
            ]
        ];

        $this->view("painel/projetos/adicionar",$dados);
    }





    /**
     * Método responsável por carregar a view de editar
     * um projeto
     * -----------------------------------------------------
     * @author edilson-pereira
     * -----------------------------------------------------
     */
    public function projetoEditar($id)
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

        // Busca o projeto
        $projeto = $this->objModelProjetos
            ->get(["id_projeto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        $clientes = $this->objModelClientes
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        $responsavel = $this->objModelUsuario
            ->get(["id_usuario" => $projeto->id_usuario])
            ->fetch(\PDO::FETCH_OBJ);

        $dados = [
            "usuario" => $usuario,
            "clientes" => $clientes,
            "projeto" => $projeto,
            "responsavel" => $responsavel,
            "js" => [
                "modulos" => ["Projeto"]
            ]
        ];

        $this->view("painel/projetos/editar",$dados);
    }


    public function projetoImprimir($id)
    {
        // Redirecionamento Login
        $this->verificaLogin();

        $objProjetoFuncionario = new ProjetoFuncionario();

        // Pegando o email do usuario
        $email = $_SESSION['usuario'];

        // Buscando o usuario por email
        $usuario = $this->objModelUsuario->get(["email" => $email])->fetch(\PDO::FETCH_OBJ);
        $perfil = $this->objHelperApoio->configuraImagem($usuario);

        //Pegando o link da img
        $usuario->perfil = $perfil;

        // Busca o projeto
        $projeto = $this->objModelProjetos
            ->get(["id_projeto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        $cliente = $this->objModelClientes
            ->get(["id_cliente" => $projeto->id_cliente])
            ->fetch(\PDO::FETCH_OBJ);

        $responsavel = $this->objModelUsuario
            ->get(["id_usuario" => $projeto->id_usuario])
            ->fetch(\PDO::FETCH_OBJ);

        $equipamentos = $this->objProjetoEquipamento
            ->get(["id_projeto" => $id])
            ->fetchAll(\PDO::FETCH_OBJ);

        $total = 0;

        foreach ($equipamentos as $eq)
        {
            $eq->equipamento = $this->objModelEquipamentos
                ->get(["id_equipamento" => $eq->id_equipamento])
                ->fetch(\PDO::FETCH_OBJ);

            $total += $eq->quantidade;

            $eq->categoria = $this->objModelCategoria
                ->get(["id_categoria" => $eq->equipamento->id_categoria])
                ->fetch(\PDO::FETCH_OBJ);
        }

        $funcionarios = $objProjetoFuncionario
            ->get(["id_projeto" => $id])
            ->fetchAll(\PDO::FETCH_OBJ);

        foreach ($funcionarios as $fun)
        {
            $fun->funcionario = $this->objModelFuncionarios
                ->get(["id_funcionario" => $fun->id_funcionario])
                ->fetch(\PDO::FETCH_OBJ);
        }

        $dados = [
            "usuario" => $usuario,
            "cliente" => $cliente,
            "projeto" => $projeto,
            "responsavel" => $responsavel,
            "equipamentos" => $equipamentos,
            "funcionarios" => $funcionarios,
            "total" => $total,
            "js" => [
                "modulos" => ["Projeto"]
            ]
        ];

        $this->view("painel/projetos/imprimir",$dados);
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