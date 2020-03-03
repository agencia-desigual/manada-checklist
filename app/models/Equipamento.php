<?php
/**
 * =======================================================
 *
 *  Exemplo de Model a ser seguido pelo usuário,
 *  este simples exemplo já possui os métodos principais de
 *  um CRUD.
 *
 *  insert, update, get, delete
 *
 * =======================================================
 *
 * Autor: Edilson Pereira
 * Date: 03/03/2020
 * Time: 17:25
 *
 */

namespace Model;

use Sistema\Database;


class Equipamento extends Database
{
    private $conexao;

    // Método construtor
    public function __construct()
    {
        // Carrega o construtor da class pai
        parent::__construct();

        // Retorna a conexao
        $this->conexao = parent::getConexao();

        // Seta o nome da tablea
        parent::setTable("equipamento");

    } // END >> Fun::__construct()

} // END >> Class::Example