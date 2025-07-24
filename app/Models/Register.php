<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registers';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tipo_registro',
        'nome',
        'motivo',
        'hr_entrada',
        'hr_saida',
        'porteiro',
        'obs',
    ];
}
