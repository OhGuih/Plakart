<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'campeonato_id', 'chefe_nome']; 

    public function pilotos()
    {
        return $this->belongsToMany(Piloto::class, 'equipe_piloto');
    }

    public function campeonato() 
    {
        return $this->belongsTo(Campeonato::class, 'campeonato_id');
    }
}
