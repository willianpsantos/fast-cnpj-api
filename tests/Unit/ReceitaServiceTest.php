<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ReceitaService;

class ReceitaServiceTest extends TestCase
{
    /** @test */
    public function consultar_empresa_test()
    {
        $service = new ReceitaService();
        $cnpj = "37041955000105";

        $dados = $service->consultar($cnpj);

        $this->assertNotEmpty($dados);
    }
}
