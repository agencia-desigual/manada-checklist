<?php

namespace Controller\Api;


use Helper\Apoio;
use Model\Categoria;
use Sistema\Controller as CI_controller;
use Sistema\Helper\File;

class Equipamento extends CI_controller
{
    private $objSeguranca;
    private $objHelperApoio;
    private $objModelEquipamento;
    private $objModelCategoria;



    public function __construct()
    {
        parent::__construct();
        $this->objHelperApoio = new Apoio();
        $this->objModelEquipamento = new \Model\Equipamento();
        $this->objModelCategoria = new Categoria();
    }



    /**
     * Método responsável por realizar o cadastro
     * de um funcionario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method POST
     * @url api/equipamento/insert
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

            // Dados insert
            $salva = [
                "nome" => $post["nome"],
                "quantidade" => $post["quantidade"]
            ];

            // Verificando se é uma nova caretogoria
            if (empty($post['id_categoria']))
            {
                // Inserindo uma nova categoria
                $categoria = $this->objModelCategoria->insert(["nome" => $post['nome-categoria']]);

                // Pegando o id da categoria
                $salva ["id_categoria"] = $categoria;
            }
            else
            {
                // Pegando o id da categoria via post
                $salva["id_categoria"] = $post["id_categoria"];
            }

            //Salva o equipamento
            $insert = $this->objModelEquipamento->insert($salva);

            if ($insert != false)
            {
                //Pegando o id do equipamento que acabou de inserir
                $id = $insert;

                // Verificando se informou imagem
                if(isset($_FILES['perfil']['name']))
                {
                    $objHelperFile = new File();

                    // Criando o caminho com id do usuario
                    $caminho = "./storage/equipamento/".$id."/imagem";

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
                        $update = $this->objModelEquipamento->update(["imagem" => $arquivo],["id_equipamento" => $id]);
                    }

                }

                $objeto = $this->objModelEquipamento->get(["id_equipamento" => $id])->fetch(\PDO::FETCH_OBJ);

                $dados = [
                    "code" => 200,
                    "tipo" => true,
                    "mensagem" => "Equipamento inserido com sucesso",
                    "objeto" => $objeto
                ];

            }
            else
            {
                $dados = [
                    "mensagem" => "Erro ao inserir equipamento",
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
     * @url api/equipamento/update/{id_equipamento}
     * -----------------------------------------------------
     * @param id_equipamento
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
                "id_categoria" => $post['id_categoria'],
                "quantidade" => $post['quantidade'],
            ];

            // Verificando se informou imagem
            if(isset($_FILES['perfil']['name']))
            {
                $objHelperFile = new File();

                // Criando o caminho com id do usuario
                $caminho = "./storage/equipamento/".$id."/imagem";

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
                    $update ["imagem"] = $arquivo;
                }

            }

            $objeto = $this->objModelEquipamento->update($update,["id_equipamento" => $id]);

            $dados = [
                "code" => 200,
                "tipo" => true,
                "mensagem" => "Equipamento alterado com sucesso",
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
     * @url api/equipamento/delete/{id_equipamento}
     * -----------------------------------------------------
     * @param id_equipamento
     */
    public function delete($id)
    {
        // Verificando se o usário está logado
        $this->seguranca();

        // Verificando se enviou POST
        if($id != null && $id !=0 && $id != "")
        {
            // Verifica se o equipamento existe
            $busca = $this->objModelEquipamento->get(['id_equipamento' => $id]);

            if($busca->rowCount() > 0)
            {
                // Deletando funcinario
                $delete = $this->objModelEquipamento->delete(['id_equipamento' => $id]);

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
                        "mensagem" => "Erro ao excluir equipamento",
                        "objeto" => null
                    ];
                }// Erro ao deletar
            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Equipamento não encontrado",
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