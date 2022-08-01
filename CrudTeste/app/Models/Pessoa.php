<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf'];

    public function conta() {
        return $this->hasOne(Conta::class);
    }

    public function movimentacao() {
        return $this->hasOne(Movimento::class);
    }

    public function enderecos() {
        return $this->belongsToMany(Endereco::class);
    }
}
