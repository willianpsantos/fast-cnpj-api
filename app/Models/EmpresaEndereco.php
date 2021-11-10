<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaEndereco extends Model
{
    protected $table = "empresa_endereco";
    protected $primaryKey = "id";

    public function empresa() {
        return $this->belongsTo(Empresa::class, 'id', 'empresa_id');
    }
}
