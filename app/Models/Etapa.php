<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $table = 'etapas';

    protected $fillable = [
        'campeonato_id',
        'nome',
        'numero',
        'data',
    ];

    // Relacionamento com Campeonato
    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }

    public function pilotos()
    {
        return $this->belongsToMany(Piloto::class, 'etapa_piloto', 'etapa_id', 'piloto_id')->withPivot('posicao', 'pontos');
    }
}
