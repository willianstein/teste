<?php
/**
 * Created by PhpStorm.
 * User: NASSARTI13
 * Date: 14/03/2019
 * Time: 10:13
 */




namespace App\Teste\Usuarios\Repository;
use App\Teste\_Base\Repository\BaseRepository;
use App\Teste\Usuarios\Usuarios;
use App\Teste\Usuarios\Repository\Interfaces\UsuarioRepositoryInterface;


class UsuarioRepository extends BaseRepository implements UsuarioRepositoryInterface
{

    protected $model;

    public function __construct(Usuarios $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function buscarToken($token)
    {
        return $this->model->newquery()->where('token_troca_senha',$token)->first();
    }

    public function buscarPeloCpf($cpf)
    {
        return $this->model->newQuery()->where('cpf', $cpf)->first();
    }

    public function listarUsuarios()
    {
       return $this->model->newQuery()->orderByRaw(" nome ASC ")->get();
    }
}

