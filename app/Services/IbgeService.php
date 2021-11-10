<?php

namespace App\Services;

use App\Interfaces\IbgeServiceInterface;
use App\Interfaces\UtilsServiceInterface;

class IbgeService implements IbgeServiceInterface
{
    private $utilsService;

    public function __construct(UtilsServiceInterface $utilsService)
    {
        $this->utilsService = $utilsService;
    }

    public function retornarEstados()
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://servicodados.ibge.gov.br/api/v1/localidades/estados");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYSTATUS, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        $obj = json_decode($result);

        return $obj;
    }

    public function retornarCidades(int $codigoEstado)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://servicodados.ibge.gov.br/api/v1/localidades/estados/$codigoEstado/municipios");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYSTATUS, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        $obj = json_decode($result);

        return $obj;
    }

    public function filtrarEstado($listaEstadosIbge, string $siglaUf)
    {
        $collect = collect($listaEstadosIbge);
        $filtered = $collect->firstWhere('sigla', $siglaUf);

        if ( empty($filtered) ) {
            return false;
        }

        return $filtered;
    }

    public function filtrarCidade($listaCidadesIbge, string $nomeCidade)
    {
        $collect = collect($listaCidadesIbge);

        $upperCollect = $collect->map(function($item) {
            $nome_original = $item->nome;

            $nome = $this->utilsService->removerAcentos($nome_original);
            $nome = rtrim(ltrim($nome));
            $nome = strtoupper($nome);

            $item->nome = $nome;

            return $item;
        });

        $nomeCidadeFormatado = $this->utilsService->removerAcentos($nomeCidade);
        $nomeCidadeFormatado = rtrim(ltrim($nomeCidadeFormatado));
        $nomeCidadeFormatado = strtoupper($nomeCidadeFormatado);

        $filtered = $upperCollect->firstWhere('nome', $nomeCidadeFormatado);

        if ( empty($filtered) ) {
            return false;
        }

        return $filtered;
    }

    public function filtrarERetornarCidade(string $nomeCidade, string $uf) {
        $listaEstados = $this->retornarEstados();
        $estado = $this->filtrarEstado($listaEstados, $uf);

        if ( !$estado ) {
            return false;
        }

        $listaCidades = $this->retornarCidades($estado->id);
        $cidade = $this->filtrarCidade($listaCidades, $nomeCidade);

        return $cidade;
    }
}
