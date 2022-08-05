<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf', 'endereco_id'];

    public function conta() {
        return $this->hasOne(Conta::class);
    }

    public function movimentacao() {
        return $this->hasOne(Movimento::class);
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
}
