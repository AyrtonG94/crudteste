<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'status', 'conta_id', 'pessoa_id'];
    protected $casts = [
        'created_at' => 'datetime:d-m-y - h:m:s',
    ];

    public function pessoa() {
        return $this->belongsTo(Pessoa::class);
    }

    public function conta() {
        return $this->belongsTo(Conta::class);
    }
}
