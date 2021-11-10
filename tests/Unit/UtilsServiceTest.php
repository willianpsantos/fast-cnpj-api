<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ReceitaService;
use App\Services\UtilsService;

class UtilsServiceTest extends TestCase
{
    /** @test */
    public function remover_acentos_test()
    {
        $service = new UtilsService();
        $texto = "CUIABÁ";

        $retorno = $service->removerAcentos($texto);

        $this->assertTrue($retorno == "CUIABA");
    }
}
