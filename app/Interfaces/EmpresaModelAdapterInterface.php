<?php

namespace App\Interfaces;

interface EmpresaModelAdapterInterface
{
    /**
     * Converte os dados da empresa vindas da api da receita para um model
     *
     * @param object $dados Os dados vindos da API
     * @return App\Models\Empresa O model que reprenta a empresa
     */
    function adaptarEmpresa($dados);

    /**
     * Converte os dados relacionados ao endereço da empresa vindas da api da receita para um model
     *
     * @param object $dados Os dados vindos da API
     * @return App\Models\EmpresaEndereco O model que reprenta a empresa
     */
    function adaptarEndereco($dados, $dadosCidadeIbge = null);
}
