<?php
/**
 * Created by PhpStorm.
 * User: nassar
 * Date: 06/12/18
 * Time: 08:21
 */

namespace App\Teste\_Base\Repository\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getModel() : Model;

    public function setModel(Model $model);

    public function criar(array $param);

    public function atualizar(array $param);

    public function deletar();

    public function restaurar();

    public function mostrar($id);

}