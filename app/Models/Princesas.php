<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Princesas extends Model
{
    protected $fillable= [
    'nome',
    'idade',
    'principe',
    'ano_de_criacao'
    ];
}
