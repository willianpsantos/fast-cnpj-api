<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
    protected $primaryKey = "id";

    public $fillable = [
        'id',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'atividade_principal',
        'data_abertura',
        'natureza_juridica'
    ];

    public function enderecos() {
        return $this->hasMany(EmpresaEndereco::class, 'empresa_id', 'id');
    }

    public function scopeCnpjJaCadastrado($query, $cnpj) {
        return $query->where('cnpj', $cnpj)->count() > 0;
    }

    public function scopeByCnpj($query, $cnpj) {
        return $query->where('cnpj', $cnpj)->first();
    }
}
