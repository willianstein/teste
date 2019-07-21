<?php


namespace App\Teste\Pedidos\Repository;


use App\Teste\_Base\Repository\BaseRepository;
use App\Teste\Pedidos\Pedidos;
use App\Teste\Pedidos\Repository\Interfaces\PedidosInterface;

class PedidosRepository extends BaseRepository implements PedidosInterface
{

    protected $model;

    public function __construct(Pedidos $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}