<?php

namespace App\Teste\Produtos;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'id',
        'descricao',
        'nomeproduto',
        'preco',
        'sku',
    ];
}
