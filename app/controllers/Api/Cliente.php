<?php

namespace Controller\Api;


use Helper\Apoio;
use Sistema\Controller as CI_controller;
use Sistema\Helper\File;

class Cliente extends CI_controller
{
    private $objSeguranca;
    private $objHelperApoio;
    private $objModelCliente;



    public function __construct()
    {
        parent::__construct();
        $this->objHelperApoio = new Apoio();
        $this->objModelCliente = new \Model\Cliente();
    }



    /**
     * Método responsável por realizar o cadastro
     * de um funcionario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method POST
     * @url api/cliente/insert
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

            $salva = [
                "nome" => $post['nome'],
            ];

            $objeto = $this->objModelCliente->insert($salva);

            if ($objeto)
            {
                $dados = [
                    "code" => 200,
                    "tipo" => true,
                    "mensagem" => "Empresa cadastrada com sucesso",
                    "objeto" => $objeto
                ];
            }
            else
            {
                $dados = ["mensagem" => "Erro ao cadastrar empresa"];
            }

        }
        else
        {
            $dados = [ "mensagem" => "Dados não enviados"];
        }// Dados não enviados

        $this->api($dados);
    }



    /**
     * Método responsável por realizar o UPDATE
     * de um cliente
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method PUT
     * @url api/cliente/update/{id_cliente}
     * -----------------------------------------------------
     * @param id_cliente
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

            $update = [
                "nome" => $post['nome'],
            ];

            $objeto = $this->objModelCliente->update($update,["id_cliente" => $id]);

            if ($objeto)
            {
                $dados = [
                    "code" => 200,
                    "tipo" => true,
                    "mensagem" => "Empresa alterado com sucesso",
                    "objeto" => $objeto
                ];
            }
            else
            {
                $dados = ["mensagem" => "Erro ao editar empresa"];
            }

        }
        else
        {
            $dados = [ "mensagem" => "Dados não enviados"];
        }// Dados não enviados

        $this->api($dados);
    }



    /**
     * Método responsável por DELETAR um usuário
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method PUT
     * @url api/cliente/delete/{id_cliente}
     * -----------------------------------------------------
     * @param id_cliente
     */
    public function delete($id)
    {
        // Verificando se o usário está logado
        $this->seguranca();

        // Verificando se enviou POST
        if($id != null && $id !=0 && $id != "")
        {
            // Verifica se o funcionario existe
            $busca = $this->objModelCliente->get(['id_cliente' => $id]);

            if($busca->rowCount() > 0)
            {
                // Deletando empresa
                $delete = $this->objModelCliente->delete(['id_cliente' => $id]);

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
                        "mensagem" => "Erro ao excluir empresa",
                        "objeto" => null
                    ];
                }// Erro ao deletar
            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Empresa não encontrado",
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