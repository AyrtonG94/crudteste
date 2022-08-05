<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'numero', 'logradouro', 'bairro','complemento', 'uf', 'municipio'];

    public function pessoa() {
        return $this->hasMany(Pessoa::class);
    }
}
