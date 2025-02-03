<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    use HasFactory;

    protected $table = 'pilotos';

    protected $fillable = [
        'nome',
        'numero',
    ];

    public function equipe()
    {
        return $this->belongsToMany(Equipe::class, 'equipe_piloto', 'piloto_id', 'equipe_id');
    }
}
