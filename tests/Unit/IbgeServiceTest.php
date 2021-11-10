<?php

namespace Tests\Unit;

use App\Services\IbgeService;
use PHPUnit\Framework\TestCase;
use App\Services\ReceitaService;
use App\Services\UtilsService;

class IbgeServiceTest extends TestCase
{
    /** @test */
    public function retornar_estados_test()
    {
        $utilsService = new UtilsService();
        $service = new IbgeService($utilsService);
        $dados = $service->retornarEstados();

        $this->assertNotEmpty($dados);
        $this->assertTrue(count($dados) > 0);
    }

    /** @test */
    public function filtrar_estado_test() {
        $utilsService = new UtilsService();
        $service = new IbgeService($utilsService);
        $dados = $service->retornarEstados();

        if ( !$dados ) {
            $this->fail('Consulta de estados não retornou dados');
            return;
        }

        $estado = $service->filtrarEstado($dados, 'MT');

        $this->assertNotEmpty($estado);
        $this->assertTrue($estado->sigla == 'MT');
    }

    /** @test */
    public function retornar_cidades_test() {
        $utilsService = new UtilsService();
        $service = new IbgeService($utilsService);
        $codigoEstadoMT = 51;
        $dados = $service->retornarCidades($codigoEstadoMT);

        $this->assertNotEmpty($dados);
        $this->assertTrue(count($dados) > 0);
    }

    /** @test */
    public function filtrar_cidade_test() {
        $utilsService = new UtilsService();
        $service = new IbgeService($utilsService);
        $codigoEstadoMT = 51;
        $dados = $service->retornarCidades($codigoEstadoMT);

        if ( !$dados ) {
            $this->fail('Consulta de cidades não retornou dados');
            return;
        }

        $cidade = $service->filtrarCidade($dados, 'cuiabá');

        $this->assertNotEmpty($cidade);
        $this->assertTrue($cidade->id == 5103403);
    }

    /** @test */
    public function filtrar_retornar_cidade_test() {
        $utilsService = new UtilsService();
        $service = new IbgeService($utilsService);
        $cidade = $service->filtrarERetornarCidade('cuiaba', 'MT');

        $this->assertNotEmpty($cidade);
        $this->assertTrue($cidade->id == 5103403);
    }
}
