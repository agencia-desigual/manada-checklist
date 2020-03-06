<?php

namespace Controller\Api;


use Helper\Apoio;
use Sistema\Controller as CI_controller;
use Sistema\Helper\File;

class Funcionario extends CI_controller
{
    private $objSeguranca;
    private $objHelperApoio;
    private $objModelFuncionario;



    public function __construct()
    {
        parent::__construct();
        $this->objHelperApoio = new Apoio();
        $this->objModelFuncionario = new \Model\Funcionario();
    }



    /**
     * Método responsável por realizar o cadastro
     * de um funcionario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method POST
     * @url api/funcionario/insert
     * -----------------------------------------------------
     * @param null
     */
    public function insert()
    {

        // Verificando se o usário está logado
        $this->seguranca();

        // Varivaeis
        $dados = null;
        $post = null;

        // Verificando se enviou POST
        if(isset($_POST))
        {
            $post = $_POST;

            // Verfificando o status
            if(isset($post['status'])){ $status = 1; } else { $status = 0; }

            $salva = [
                "nome" => $post['nome'],
                "cargo" => $post['cargo'],
                "status" => $status
            ];

            //Salva o usuario
            $insert = $this->objModelFuncionario->insert($salva);

            if ($insert != false)
            {
                //Pegando o id do usuario que acabou de inserir
                $id = $insert;

                // Verificando se informou imagem
                if(isset($_FILES['perfil']['name']))
                {
                    $objHelperFile = new File();

                    // Criando o caminho com id do usuario
                    $caminho = "./storage/funcionario/".$id."/perfil";

                    // Verifica se já existe
                    if(!is_dir($caminho))
                    {
                        // Cria o diretorio
                        mkdir($caminho, 0777, true);
                    }

                    // Configurações para upload
                    $objHelperFile->setMaxSize(2 * MB);
                    $objHelperFile->setFile($_FILES["perfil"]);
                    $objHelperFile->setStorange($caminho);

                    $arquivo = $objHelperFile->upload();

                    if ($arquivo != null && $arquivo != false)
                    {
                        $update = $this->objModelFuncionario->update(["perfil" => $arquivo],["id_funcionario" => $id]);
                    }

                }

                $objeto = $this->objModelFuncionario->get(["id_funcionario" => $id])->fetch(\PDO::FETCH_OBJ);

                $dados = [
                    "code" => 200,
                    "tipo" => true,
                    "mensagem" => "Funcionário inserido com sucesso",
                    "objeto" => $objeto
                ];

            }
        }
        else
        {
            $dados = [
                "tipo" => false,
                "mensagem" => "Dados não enviados",
                "objeto" => null
            ];
        }// Dados não enviados

        $this->api($dados);
    }



    /**
     * Método responsável por realizar o UPDATE
     * de um funcionario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method PUT
     * @url api/funcionario/update/{id_funcionario}
     * -----------------------------------------------------
     * @param id_funcionario
     */
    public function update($id)
    {
        // Verificando se o usário está logado
        $this->seguranca();

        // Varivaeis
        $dados = null;
        $post = null;

        // Verificando se enviou POST
        if(isset($_POST))
        {
            $post = $_POST;

            if(isset($post['status'])){ $status = 1; } else { $status = 0; }

            $update = [
                "nome" => $post['nome'],
                "cargo" => $post['cargo'],
                "status" => $status
            ];

            // Verificando se informou imagem
            if(isset($_FILES['perfil']['name']))
            {
                $objHelperFile = new File();

                // Criando o caminho com id do usuario
                $caminho = "./storage/funcionario/".$id."/perfil";

                // Verifica se já existe
                if(!is_dir($caminho))
                {
                    // Cria o diretorio
                    mkdir($caminho, 0777, true);
                }

                // Configurações para upload
                $objHelperFile->setMaxSize(2 * MB);
                $objHelperFile->setFile($_FILES["perfil"]);
                $objHelperFile->setStorange($caminho);

                $arquivo = $objHelperFile->upload();

                if ($arquivo != null && $arquivo != false)
                {
                    $update ["perfil"] = $arquivo;
                }

            }

            $objeto = $this->objModelFuncionario->update($update,["id_funcionario" => $id]);

            $dados = [
                "code" => 200,
                "tipo" => true,
                "mensagem" => "Funcionario alterado com sucesso",
                "objeto" => $objeto
            ];

        }
        else
        {
            $dados = [
                "tipo" => false,
                "mensagem" => "Dados não enviados",
                "objeto" => null
            ];
        }// Dados não enviados

        $this->api($dados);
    }



    /**
     * Método responsável por DELETAR um usuário
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method PUT
     * @url api/usuario/delete/{id_funcionario}
     * -----------------------------------------------------
     * @param id_funcionario
     */
    public function delete($id)
    {
        // Verificando se o usário está logado
        $this->seguranca();

        // Verificando se enviou POST
        if($id != null && $id !=0 && $id != "")
        {
            // Verifica se o funcionario existe
            $busca = $this->objModelFuncionario->get(['id_funcionario' => $id]);

            if($busca->rowCount() > 0)
            {
                // Deletando funcinario
                $delete = $this->objModelFuncionario->delete(['id_funcionario' => $id]);

                if ($delete != null)
                {
                    $dados = [
                        "code" => 200,
                        "tipo" => true,
                        "mensagem" => "Excluido com sucesso",
                        "objeto" => null
                    ];
                }
                else
                {
                    $dados = [
                        "tipo" => false,
                        "mensagem" => "Erro ao excluir funcionario",
                        "objeto" => null
                    ];
                }// Erro ao deletar
            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Funcionario não encontrado",
                    "objeto" => null
                ];
            }
        }
        else
        {
            $dados = [
                "tipo" => false,
                "mensagem" => "Dados não enviados",
                "objeto" => null
            ];
        }// Dados não enviados

        $this->api($dados);
    }


    /**
     * Método responsável por validar a sessão
     * do usuario, se não tiver ele não autoriza a
     * continuaçãa da função
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method null
     * @url null
     * -----------------------------------------------------
     * @param null
     */
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