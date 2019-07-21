<?php
/**
 * Created by PhpStorm.
 * User: nassar
 * Date: 06/12/18
 * Time: 08:21
 */

namespace App\Teste\_Base\Repository;


use App\Teste\_Base\Repository\Interfaces\BaseRepositoryInterface;
use Czim\Filter\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function criar(array $param)
    {
        try {
            return $this->model->create($param);
        } catch (QueryException $e) {
            throw new \Exception($e->getMessage(), 500, $e);
        }
    }

    public function atualizar(array $param)
    {
        try {
            return $this->model->update($param);
        } catch (QueryException $e) {
            throw new \Exception($e->getMessage(), 500, $e);
        }
    }

    public function deletar()
    {
        return $this->model->delete();
    }

    public function deletarRealmente()
    {
        return $this->model->forceDelete();
    }

    public function restaurar()
    {
        return $this->model->restore();
    }

    public function mostrar($id, $falhaSeNaoAcha = true)
    {
        if ($falhaSeNaoAcha)
            return $this->model->findOrFail($id);
        else
            return $this->model->find($id);
    }

    public function buscarTodosFiltrado(Filter $filter, string $order = 'id', string $sort = 'desc')
    {
        return $filter->apply($this->model->newQuery())->orderBy($order, $sort)->get();
    }

    public function buscarUmFiltrado(Filter $filter)
    {
        return $filter->apply($this->model->newQuery())->first();
    }
}