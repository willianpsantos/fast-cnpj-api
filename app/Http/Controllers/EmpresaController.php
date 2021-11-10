<?php

namespace App\Http\Controllers;

use App\Interfaces\ReceitaServiceInterface;
use App\Interfaces\IbgeServiceInterface;
use App\Interfaces\EmpresaModelAdapterInterface;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /** @var ReceitaServiceInterface */
    private $receitaService;

    /** @var IbgeServiceInterface */
    private $ibgeService;

    /** @var EmpresaModelAdapterInterface */
    private $empresaModelAdapter;

    public function __construct(
        ReceitaServiceInterface $receitaService,
        IbgeServiceInterface $ibgeService,
        EmpresaModelAdapterInterface $empresaAdapter
    )
    {
        $this->receitaService = $receitaService;
        $this->ibgeService = $ibgeService;
        $this->empresaModelAdapter = $empresaAdapter;
    }

    public function get(string $cnpj) {
        if ( empty($cnpj) ) {
            return response('CNPJ não informado', 400);
        }

        $dados = $this->receitaService->consultar($cnpj);

        if ( empty($dados) ) {
            return response('Empresa não encontrada', 404);
        }

        $model_empresa = $this->empresaModelAdapter->adaptarEmpresa($dados);
        $cnpj_ja_existe = $model_empresa->cnpjJaCadastrado($model_empresa->cnpj);
        $cidade_ibge = $this->ibgeService->filtrarERetornarCidade($dados->municipio, $dados->uf);
        $dados->municipio_codigo_ibge = !empty($cidade_ibge) ? $cidade_ibge->id : null;

        if ( !$cnpj_ja_existe ) {
            $model_endereco = $this->empresaModelAdapter->adaptarEndereco($dados, $cidade_ibge);

            $model_empresa->save();
            $model_empresa->enderecos()->save($model_endereco);
        }

        return response()->json($dados, 200);
    }

    public function put(Request $request, $cnpj) {
        if ( empty($cnpj) ) {
            return response('CNPJ não informado', 400);
        }

        $inputs = $request->all();

        if ( empty($inputs) ) {
            return response('Não há dados para serem atualizados!', 400);
        }

        $exists = Empresa::cnpjJaCadastrado($cnpj);

        if ( !$exists ) {
            return response("CNPJ $cnpj não está cadastrado!", 404);
        }

        $model = Empresa::byCnpj($cnpj);
        $model->fill($inputs);
        $model->save();

        if ( !isset($inputs['endereco']) || empty($inputs['endereco']) ) {
            return response("Dados atualizados!", 200);
        }

        $model->enderecos()->update($inputs['endereco']);

        return response("Dados atualizados!", 200);
    }

    public function delete(string $cnpj) {
        if ( empty($cnpj) ) {
            return response('CNPJ não informado', 400);
        }

        $model = Empresa::byCnpj($cnpj);

        if ( empty($model) ) {
            return response('CNPJ não encontrado!', 404);
        }

        $model->enderecos()->delete();
        $model->delete();

        return response("Empresa CNPJ $cnpj excluída com sucesso!", 200);
    }
}
