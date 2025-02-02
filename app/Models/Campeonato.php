<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'etapas']; // Permite inserção em massa desses campos
    public function equipes()
{
    return $this->hasMany(Equipe::class, 'campeonato_id');
}

}
