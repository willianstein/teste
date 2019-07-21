<?php

namespace App\Teste\Pedidos;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedido';

    protected $fillable = [
        'id',
        'data',
        'produtos',
        'total',
    ];
}
