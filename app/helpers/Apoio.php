<?php

/**
 * Classe responsável por conter métodos que auxiliam no desenvolvimento
 * de softwares.
 */

// NameSpace
namespace Helper;

// Inicia a classe
class Apoio
{

    /**
     * Método responsável por formatar um numero na casa do milhar, deixando
     * em siglas K,M,B,T,Q
     * ---------------------------------------------------------------------
     * @param null|int $numero
     * @return string
     */
    public function formatNumero($numero = null)
    {
        // Variaveis
        $cont = 0;
        $array  = ["","K","M","B","T","Q"];

        // Divide o numero por mil
        while ($numero >= 1000)
        {
            $numero = $numero / 1000;
            $cont++;
        }


        // Verifica se o numero não é inteiro
        if(is_int($numero) == false)
        {
            // Deixa com duas casas decimais
            $numero = number_format($numero,2,".");
        }

        // Retorna o numero com a letra
        return $numero . $array[$cont];
    }


    /**
     * Método responsável por formatar a url certa
     * da imagem de perfil do usuário
     * ------------------------------------------------------------------
     * @author igorcacerez
     * ------------------------------------------------------------------
     * @param $perfil
     * @return string
     */
    public function configuraImagem($obj)
    {
        $retorno = null;

        // Verifica se é alguma coisa
        if($obj != null)
        {
            // Verificando se é um usuario
            if (!empty($obj->id_usuario))
            {
                if ($obj->perfil == "avatar-nulo.png" || $obj->perfil == null)
                {
                    $retorno = BASE_URL.'assets/custom/img/avatar-nulo.png';
                }
                else
                {
                    $retorno = BASE_STORAGE.'usuario/'.$obj->id_usuario.'/perfil/'.$obj->perfil;
                }
            }
            elseif (!empty($obj->id_funcionario))
            {
                if ($obj->perfil == "avatar-nulo.png" || $obj->perfil == null)
                {
                    $retorno = BASE_URL.'assets/custom/img/avatar-nulo.png';
                }
                else
                {
                    $retorno = BASE_STORAGE.'funcionario/'.$obj->id_funcionario.'/perfil/'.$obj->perfil;
                }
            }
            else
            {
                if ($obj->imagem == "equipamento-nulo.png" || $obj->imagem == null)
                {
                    $retorno = BASE_URL.'assets/custom/img/equipamento-nulo.png';
                }
                else
                {
                    $retorno = BASE_STORAGE.'equipamento/'.$obj->id_equipamento.'/imagem/'.$obj->imagem;
                }
            }// Caso for um equipamento
        }

        return $retorno;

    } // End >> fun::configuraPerfil()


} // End >> Class::Apoio()