<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;
    
    protected $fillable = ['conta', 'saldo','pessoa_id'];

    public function pessoa() {
        return $this->belongsTo(Pessoa::class);
    }

    public function movimentacao() {
        return $this->hasOne(Movimento::class);
    }
}
