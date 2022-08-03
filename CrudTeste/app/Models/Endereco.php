<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'numero', 'logradouro', 'bairro', 'uf', 'municipio', 'pessoa_id'];

    public function pessoas() {
        return $this->belongsTo(Pessoa::class);
    }
}
