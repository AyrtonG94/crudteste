<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'numero', 'logradouro', 'bairro','complemento', 'uf', 'municipio', 'pessoa_id'];

    public function pessoa() {
        return $this->belongsTo(Pessoa::class);
    }
}
