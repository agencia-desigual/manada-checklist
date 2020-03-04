<?php

namespace Controller\Api;


use Helper\Apoio;
use Sistema\Controller as CI_controller;
use Sistema\Helper\File;

class Usuario extends CI_controller
{
    private $objSeguranca;
    private $objHelperApoio;
    private $objModelUsuario;


    public function __construct()
    {
        parent::__construct();
        $this->objHelperApoio = new Apoio();
        $this->objModelUsuario = new \Model\Usuario();
    }



    /**
     * Método responsável por realizar o login
     * do usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method POST
     * @url api/usuario/login
     * -----------------------------------------------------
     * @param null
     */
    public function login()
    {
        // Variaveis
        $dados = null;
        $post = null;

        // Verificando se foi enviado o POST
        if(isset($_POST))
        {
            // Pegando os dados do POST
            $post = $_POST;

            // Pegando os dados
            $email = $post['email'];
            $senha = md5($post['senha']);

            // Verificando se o usuario existe
            $busca = $this->objModelUsuario->get(["email" => $email, "senha" => $senha]);

            if ($busca->rowCount() == 1)
            {
                // Pegando o usuario
                $usuario = $this->objModelUsuario->get(["email" => $email, "senha" => $senha])->fetch(\PDO::FETCH_OBJ);


                // Adicionando o usuario na SESSION
                $_SESSION['usuario'] = $usuario->email;

                $dados = [
                    "tipo" => true,
                    "mensagem" => "Logado com sucesso",
                    "objeto" => $busca->fetch(\PDO::FETCH_OBJ)
                ];
            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Usuário não encontrado"
                ];
            }// Usuario não encontrado


        }
        else
        {
            $dados = [
                "tipo" => false,
                "mensagem" => "Dados não enviados"
            ];

        }// Dados não enviados

        // Enviando os dados via JSON
        $this->api($dados);

    }



    /**
     * Método responsável por realizar o cadastro
     * de um usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method POST
     * @url api/usuario/insert
     * -----------------------------------------------------
     * @param null
     */
    public function insert()
    {

        // Adicionando o usuario na SESSION
        $_SESSION['usuario']['nome'] = "Edilson";
        $_SESSION['usuario']['email'] = "edilson@desigual.com.br";

        // Verificando se o usário está logado
        $this->seguranca();

        // Varivaeis
        $dados = null;
        $post = null;

        // Verificando se enviou POST
        if(isset($_POST))
        {
            // Pegando os dados
            $post = $_POST;

            // Verificando se as senhas são iguais
            if($post['senha'] == $post['senha_repete'])
            {
                // Buscando pelo email
                $busca = $this->objModelUsuario->get(["email" => $post['email']]);

                if($busca->rowCount() == 0)
                {
                    $salva = [
                        "nome" => $post['nome'],
                        "email" => $post['email'],
                        "senha" => md5($post['senha']),
                    ];

                    //Salva o usuario
                    $insert = $this->objModelUsuario->insert($salva);

                    if ($insert != false)
                    {
                        //Pegando o id do usuario que acabou de inserir
                        $id = $insert;

                        // Verificando se informou imagem
                        if(isset($_FILES['perfil']['name']))
                        {
                            $objHelperFile = new File();

                            // Criando o caminho com id do usuario
                            $caminho = "./storage/usuario/".$id;

                            // Verifica se já existe
                            if(!is_dir($caminho))
                            {
                                // Cria o diretorio
                                mkdir($caminho, 0777, true);
                            }

                            // Configurações para upload
                            $objHelperFile->setMaxSize(2 * MB);
                            $objHelperFile->setFile($_FILES["arquivo"]);
                            $objHelperFile->setStorange($caminho . "/perfil");

                            $arquivo = $objHelperFile->upload(true);

                            if ($arquivo != null && $arquivo != false)
                            {
                                $update = $this->objModelUsuario->update(["perfil" => $arquivo],["id_usuario" => $id]);

                            }

                        }

                        $objeto = $this->objModelUsuario->get(["id_usuario" => $id])->fetch(\PDO::FETCH_OBJ);

                        $dados = [
                            "code" => 200,
                            "tipo" => true,
                            "mensagem" => "Usuário inserido com sucesso",
                            "objeto" => $objeto
                        ];

                    }
                    else
                    {
                        $dados = [
                            "tipo" => false,
                            "mensagem" => "Erro ao cadastrar",
                            "objeto" => null
                        ];
                    }// Erro ao inserir usuário

                }
                else
                {
                    $dados = [
                        "tipo" => false,
                        "mensagem" => "O email já está sendo utilizado",
                        "objeto" => null
                    ];
                }// Email já existe

            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Senhas diferentes",
                    "objeto" => null
                ];
            }// Senhas diferentes
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
     * de um usuario
     * -----------------------------------------------------
     * @author edilson-pereira
     * @method PUT
     * @url api/usuario/update/{id_usuario}
     * -----------------------------------------------------
     * @param id_usuario
     */
    public function update($id)
    {
        // Adicionando o usuario na SESSION
        $_SESSION['usuario']['nome'] = "Edilson";
        $_SESSION['usuario']['email'] = "edilson@desigual.com.br";

        // Verificando se o usário está logado
        $this->seguranca();

        // Varivaeis
        $dados = null;
        $post = null;

        // Verificando se enviou POST
        if(isset($_POST))
        {
            // Pegando os dados
            $post = $_POST;

            // Verificando se as senhas são iguais
            if($post['senha'] == $post['senha_repete'])
            {
                $update = [
                    "nome" => $post['nome'],
                    "email" => $post['email'],
                    "senha" => md5($post['senha']),
                ];

                // Verificando se informou imagem
                if(isset($_FILES['perfil']['name']))
                {
                    $objHelperFile = new File();

                    // Criando o caminho com id do usuario
                    $caminho = "./storage/usuario/".$id;

                    // Verifica se já existe
                    if(!is_dir($caminho))
                    {
                        // Cria o diretorio
                        mkdir($caminho, 0777, true);
                    }

                    // Configurações para upload
                    $objHelperFile->setMaxSize(2 * MB);
                    $objHelperFile->setFile($_FILES["perfil"]);
                    $objHelperFile->setStorange($caminho . "/perfil");

                    $arquivo = $objHelperFile->upload();

                    if ($arquivo != null && $arquivo != false)
                    {
                        $update = ["perfil" => $arquivo];
                    }

                }


                // Update do usuario
                $altera = $this->objModelUsuario->update([$update],["id_usuario" => $id]);

                if ($altera != false)
                {
                    //Pegando o id do usuario que acabou de inserir
                    $id = $altera;

                    $objeto = $this->objModelUsuario->get(["id_usuario" => $id])->fetch(\PDO::FETCH_OBJ);

                    $dados = [
                        "code" => 200,
                        "tipo" => true,
                        "mensagem" => "Usuário alterado com sucesso",
                        "objeto" => $objeto
                    ];

                }
                else
                {
                    $dados = [
                        "tipo" => false,
                        "mensagem" => "Erro ao alterar",
                        "objeto" => null
                    ];
                }// Erro ao inserir usuário

            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Senhas diferentes",
                    "objeto" => null
                ];
            }// Senhas diferentes
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
     * @url api/usuario/delete/{id_usuario}
     * -----------------------------------------------------
     * @param id_usuario
     */
    public function delete($id)
    {
        // Adicionando o usuario na SESSION
        $_SESSION['usuario']['nome'] = "Edilson";
        $_SESSION['usuario']['email'] = "edilson@desigual.com.br";

        // Verificando se o usário está logado
        $this->seguranca();

        // Verificando se enviou POST
        if($id != null && $id !=0 && $id != "")
        {
            // Verifica se o usuario existe
            $busca = $this->objModelUsuario->get(['id_usuario' => $id]);

            if($busca->rowCount() > 0)
            {
                // Deletando usuario
                $delete = $this->objModelUsuario->delete(['id_usuario' => $id]);

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
                        "mensagem" => "Erro ao excluir usuário",
                        "objeto" => null
                    ];
                }// Erro ao deletar
            }
            else
            {
                $dados = [
                    "tipo" => false,
                    "mensagem" => "Usuário não encontrado",
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