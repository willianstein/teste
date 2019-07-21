<?php


namespace App\Teste\Produtos\Repository;


use App\Teste\_Base\Repository\BaseRepository;
use App\Teste\Produtos\Produtos;
use App\Teste\Produtos\Repository\Interfaces\ProdutosInterfaces;

class ProdutosRepository extends BaseRepository implements ProdutosInterfaces
{
    protected $model;

    public function __construct(Produtos $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function listarProdutos()
    {
        return $this->model->newQuery()->orderBy("nomeproduto")->get();
    }
}