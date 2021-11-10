<?php

namespace App\Interfaces;

interface IbgeServiceInterface
{
    /**
     * Retorna as informações dos estados de acordo com o IBGE
     *
     * @return object Uma lista com os estados do Brasil
     */
    function retornarEstados();

    /**
     * Retorna as cidades do estado.
     *
     * @param int $codigoEstado O codigo do estado (de acordo com o IBGE)
     * @return array Uma lista com as cidades do estado.
     */
    function retornarCidades(int $codigoEstado);

    /**
     * Retorna as informações de um estado extraídas de uma lista de estados obtidas do IBGE.
     *
     * @param array $listaEstadosIbge A lista de estados obtidos pelo IBGE
     * @param string $siglaUf A sigla do estado que se deseja pesquisar
     * @return object As informaçoes do estado encontrado, ou false, caso o estado não seja encontrado.
     */
    function filtrarEstado($listaEstadosIbge, string $siglaUf);

    /**
     * Retorna as informações de uma cidade extraídas de uma lista de cidades obtidas do IBGE.
     *
     * @param array $listaCidadesIbge A lista de cidades obtidas pelo IBGE
     * @param string $nomeCidade O nome da cidade
     * @return object As informaçoes da cidade encontrada, ou false, caso a cidade não seja encontrada.
     */
    function filtrarCidade($listaCidadesIbge, string $nomeCidade);

    /**
     * Buscar as informações no IBGE e em seguida filtra as informações da cidade desejada.
     *
     * @param string $nomeCidade O nome da cidade
     * @param string $uf A sigla do estado
     * @return object As informaçoes da cidade encontrada, ou false, caso a cidade não seja encontrada.
     */
    function filtrarERetornarCidade(string $nomeCidade, string $uf);
}
