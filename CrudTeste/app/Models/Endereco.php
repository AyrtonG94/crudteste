<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'numero', 'logradouro', 'bairro', 'uf', 'municipio'];

    public function pessoas() {
        return $this->belongsToMany(Pessoa::class, 'pessoas_enderecos', 'pessoa_id');
    }
}
