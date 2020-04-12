<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 11/03/2020
 * Time: 10:38
 */

namespace Controller\Api;

// Importação
use Helper\Apoio;
use Model\ProjetoEquipamento;
use Model\ProjetoFuncionario;
use Sistema\Controller;

// Classe
class Projeto extends Controller
{
    // Objetos
    private $objModelProjeto;
    private $objModelProjetoEquipamento;
    private $objModelProjetoFuncionario;
    private $objModelUsuario;

    private $objHelperApoio;

    // método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProjeto = new \Model\Projeto();
        $this->objModelProjetoEquipamento = new ProjetoEquipamento();
        $this->objModelProjetoFuncionario = new ProjetoFuncionario();
        $this->objModelUsuario = new \Model\Usuario();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por realizar as verificações
     * necessárias e adionar um projeto no banco de
     * dados.
     * ---------------------------------------------------
     * @author igorcacerez
     * ---------------------------------------------------
     * @url api/projeto/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $usuario = null;
        $projeto = null;
        $post = null;
        $salva = null;

        // Seguranca
        $usuario = $this->seguranca();

        // Recupera os dados POST
        $post = $_POST;

        // Verifica se informou os itens obrigatorios
        if(!empty($post["id_cliente"]) &&
            !empty($post["nome"]) &&
            !empty($post["local"]) &&
            !empty($post["horario"]) &&
            !empty($post["data_ida"]) &&
            !empty($post["data_volta"]))
        {
            // Monta o array de inserção do projeto
            $salva = [
                "id_usuario" => $usuario->id_usuario,
                "id_cliente" => $post["id_cliente"],
                "nome" => $post["nome"],
                "local" => $post["local"],
                "horario" => $post["horario"],
                "data_ida" => $post["data_ida"],
                "data_volta" => $post["data_volta"],
                "data_cadastro" => date("Y-m-d H:i:s"),
                "status" => true
            ];

            // Verifica se informou as observações
            if(!empty($post["observacoes"]))
            {
                $salva["observacoes"] = $post["observacoes"];
            }

            // Insere
            $projeto = $this->objModelProjeto->insert($salva);

            // Verifica se inseriu
            if($projeto != false)
            {
                if(!empty($post["funcionarios"]))
                {
                    // Percorre os equipamentos
                    foreach ($post["funcionarios"] as $id => $funcao)
                    {
                        // Verifica se a quantidade é maior que 0
                        if($funcao != 0 || $funcao != "0")
                        {
                            // Array
                            $salvaFun = [
                                "id_projeto" => $projeto,
                                "id_funcionario" => $id,
                                "funcao" => $funcao
                            ];

                            // Vincula o funcionario
                            $this->objModelProjetoFuncionario->insert($salvaFun);
                        }
                    }
                }

                if(!empty($post["equipamentos"]))
                {
                    // Percorre os equipamentos
                    foreach ($post["equipamentos"] as $id => $quantidade)
                    {
                        // Verifica se a quantidade é maior que 0
                        if($quantidade > 0)
                        {
                            // Array
                            $salvaEq = [
                                "id_projeto" => $projeto,
                                "id_equipamento" => $id,
                                "quantidade" => $quantidade
                            ];

                            // Vincula
                            $this->objModelProjetoEquipamento->insert($salvaEq);
                        }
                    }
                }

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Projeto adicionado com sucesso.",
                    "objeto" => $projeto
                ];
            }
            else
            {
                // Erro
                $dados = ["mensagem" => "Erro ao adionar projeto."];
            } // Error >> Erro ao adionar projeto.
        }
        else
        {
            // Erro
            $dados = ["mensagem" => "Campos obrigatórios não informados."];
        } // Error >> Campos obrigatórios não informados.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por deletar um determinado
     * projeto e seus FKs
     * ---------------------------------------------------
     * @param $id
     * ---------------------------------------------------
     * @url api/projeto/delete/ID
     * @method POST
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $projeto = null;

        // Segurança
        $usuario = $this->seguranca();

        // Busca o projeto
        $projeto = $this->objModelProjeto
            ->get(["id_projeto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o projeto existe
        if(!empty($projeto))
        {
            // Deleta os funcionarios
            $this->objModelProjetoFuncionario->delete(["id_projeto" => $id]);

            // Deleta os equipamentos
            $this->objModelProjetoEquipamento->delete(["id_projeto" => $id]);

            // Deleta o projeto
            if($this->objModelProjeto->delete(["id_projeto" => $id]) != false)
            {
                // Avisa que deu bom
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Projeto deletado com sucesso.",
                    "objeto" => $projeto
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Erro ao deletar projeto."];

            } // Error >> Erro ao deletar projeto.
        }
        else
        {
            // Error
            $dados = ["mensagem" => "Projeto não existe."];

        } // Error >> Projeto não existe

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()


    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $projeto = null;
        $post = $_POST;

        // Seguranca
        $usuario = $this->seguranca();

        // Busca o projeto
        $projeto = $this->objModelProjeto
            ->get(["id_projeto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        if(!empty($post["funcionarios"]))
        {
            // Primeiro apaga os antigo para depois inserir os novos
            $this->objModelProjetoFuncionario->delete(["id_projeto" => $id]);

            // Percorre os funcionarios
            foreach ($post["funcionarios"] as $idfun => $funcao)
            {
                // Verifica se a quantidade é maior que 0
                if($funcao != 0 || $funcao != "0")
                {
                    // Array
                    $salvaFun = [
                        "id_projeto" => $projeto->id_projeto,
                        "id_funcionario" => $idfun,
                        "funcao" => $funcao
                    ];

                    // Vincula o funcionario
                    $this->objModelProjetoFuncionario->insert($salvaFun);
                }
            }
        }

        if(!empty($post["equipamentos"]))
        {

            // Primeiro apaga os antigo para depois inserir os novos
            $this->objModelProjetoEquipamento->delete(["id_projeto" => $id]);


            // Percorre os equipamentos
            foreach ($post["equipamentos"] as $id => $quantidade)
            {
                // Verifica se a quantidade é maior que 0
                if($quantidade > 0)
                {
                    // Array
                    $salvaEq = [
                        "id_projeto" => $projeto->id_projeto,
                        "id_equipamento" => $id,
                        "quantidade" => $quantidade
                    ];

                    // Atualiza o equipamento
                    $this->objModelProjetoEquipamento->insert($salvaEq);
                }
            }
        }

        // Verifica se existe
        if(!empty($projeto))
        {
            $updateProjeto = [
                "nome" => $post['nome'],
                "id_cliente" => $post['id_cliente'],
                "local" => $post['local'],
                "data_ida" => $post['data_ida'],
                "data_volta" => $post['data_volta'],
                "observacoes" => $post['observacoes']
            ];

            // Altera
            if($this->objModelProjeto->update($updateProjeto, ["id_projeto" => $id]) != false)
            {

                // Avisa que deu bom
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Projeto alterado com sucesso."
                ];
            }
            else
            {
                $dados = ["mensagem" => "Erro ao alterar projeto."];
            } // Error
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Projeto não existe"];
        } // Error

        // Api
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por duplicar o projeto
     * buscando todos os dados em outras tabelas e montado uma
     * array para insert
     * ---------------------------------------------------
     * @author edilson-pereira
     * ---------------------------------------------------
     * @url api/projeto/duplicar/id
     * @method POST
     */
    public function duplicar($param)
    {

        // Variaveis
        $id = $param;
        $projeto = null;
        $equipamentos = null;
        $funcionarios = null;
        $dados = null;

        // Buscando os dados na tabela projeto
        $projeto = $this->objModelProjeto->get(["id_projeto" => $id])->fetchAll(\PDO::FETCH_OBJ);

        // Pegandos todos os dados do projeto
        foreach ($projeto as $pro)
        {
            $novoProjeto = [
                "id_cliente" => $pro->id_cliente,
                "id_usuario" => $pro->id_usuario,
                "nome" => "COPIA - ".$pro->nome,
                "local" => $pro->local,
                "horario" => $pro->horario,
                "observacoes" => $pro->observacoes,
                "data_ida" => $pro->data_ida,
                "data_volta" => $pro->data_volta,
                "status" => $pro->status,
            ];

        }

        // Inserindo o novo projeto
        $insert = $this->objModelProjeto->insert($novoProjeto);

        // Verifica se pelo menos inseriu o projeto
        if ($insert)
        {
            // Pegando o id do projeto inserido
            $idNovoProjeto = $insert;

            // Buscando todos os equipamentos
            $equipamentos = $this->objModelProjetoEquipamento->get(["id_projeto" => $id])->fetchAll(\PDO::FETCH_OBJ);

            // Verificando se possui equipamentos
            if(!empty($equipamentos))
            {
                // Percorrendo todos os equipamentos do projeto e fazendo o insert
                foreach ($equipamentos as $equipamento)
                {
                    // Pegando os dados
                    $novoEquipamento = [
                        "id_projeto" => $idNovoProjeto,
                        "id_equipamento" => $equipamento->id_equipamento,
                        "quantidade" => $equipamento->quantidade
                    ];

                    // Inserindo os equipamentos
                    $this->objModelProjetoEquipamento->insert($novoEquipamento);
                }
            }

            //Buscando todos os funcionarios
            $funcionarios = $this->objModelProjetoFuncionario->get(["id_projeto" =>$id])->fetchAll(\PDO::FETCH_OBJ);

            // Verificando se possui funcionarios
            if(!empty($funcionarios))
            {
                // Percorrendo todos os equipamentos do projeto e fazendo o insert
                foreach ($funcionarios as $funcionario)
                {
                    // Pegando os dados
                    $novoFuncionario = [
                        "id_projeto" => $idNovoProjeto,
                        "id_funcionario" => $funcionario->id_funcionario,
                        "funcao" => $funcionario->funcao
                    ];

                    // Inserindo os funcionarios
                    $this->objModelProjetoFuncionario->insert($novoFuncionario);
                }
            }

            // Avisa que deu bom
            $dados = [
                "tipo" => true,
                "code" => 200,
                "mensagem" => "Projeto duplicado com sucesso."
            ];

        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Erro ao duplicar o projeto"];
        }

        // Api
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
     * @return object
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
        else
        {
            // Busca o usuário
            $usuario = $this->objModelUsuario
                ->get(["email" => $_SESSION["usuario"]])
                ->fetch(\PDO::FETCH_OBJ);

            // Configura o perfil
            $usuario->perfil = $this->objHelperApoio->configuraImagem($usuario);

            // Retorna o objeto do usuário
            return $usuario;
        }
    }

} // End >> Class::Api\Projeto