<?php

namespace App\Services;

use App\Interfaces\ReceitaServiceInterface;

class ReceitaService implements ReceitaServiceInterface
{
    public function consultar(string $cnpj) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://www.receitaws.com.br/v1/cnpj/$cnpj");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYSTATUS, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        $obj = json_decode($result);

        return $obj;
    }
}
