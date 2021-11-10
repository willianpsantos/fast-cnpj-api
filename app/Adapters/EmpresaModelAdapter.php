<?php

namespace App\Adapters;

use App\Interfaces\EmpresaModelAdapterInterface;
use App\Models\Empresa;
use App\Models\EmpresaEndereco;
use DateTime;
use DateTimeZone;

class EmpresaModelAdapter implements EmpresaModelAdapterInterface
{
    public function adaptarEmpresa($dados)
    {
        $model = new Empresa();

        $cnpj_sem_format = str_replace('.', '', $dados->cnpj);
        $cnpj_sem_format = str_replace('/', '', $cnpj_sem_format);
        $cnpj_sem_format = str_replace('-', '', $cnpj_sem_format);

        $atividade_principal =
            !empty($dados->atividade_principal) && count($dados->atividade_principal) > 0
              ? $dados->atividade_principal[0]
              : null;

        $atividade_principal_descricao =
            !empty($atividade_principal)
              ? $atividade_principal->code . ' - ' . $atividade_principal->text
              : '';

        $model->cnpj                = $cnpj_sem_format;
        $model->razao_social        = $dados->nome;
        $model->nome_fantasia       = $dados->nome;
        $model->atividade_principal = $atividade_principal_descricao;

        $data_abertura = DateTime::createFromFormat('d/m/Y', $dados->abertura);

        $model->data_abertura       = $data_abertura->format('Y-m-d');
        $model->natureza_juridica   = $dados->natureza_juridica;

        return $model;
    }

    public function adaptarEndereco($dados, $dadosCidadeIbge = null)
    {
        $model = new EmpresaEndereco();

        $model->cep = $dados->cep;
        $model->logradouro = $dados->logradouro;
        $model->codigo_ibge = null;
        $model->cidade = $dados->municipio;
        $model->estado = $dados->uf;
        $model->numero = $dados->numero;
        $model->bairro = $dados->bairro;
        $model->complemento = $dados->complemento;
        $model->pais = 'Brasil';

        if ( empty($dadosCidadeIbge) ) {
            return $model;
        }

        $model->codigo_ibge = $dadosCidadeIbge->id;

        return $model;
    }
}
