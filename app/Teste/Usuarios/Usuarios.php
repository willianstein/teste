<?php

namespace App\Teste\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Usuarios extends Authenticatable
{
    protected $table = 'usuarios';
    protected $guard = 'web';



    protected $fillable = [
        'id',
        'nome',
        'email',
        'cpf',
        'password',
        'remenber_token',
        'observacao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
