<?php
/**
 * Created by PhpStorm.
 * User: nassar
 * Date: 24/08/18
 * Time: 08:24
 */
namespace App\Teste\Helpers\Facades;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Facade;


/**
 * @method static soNumero($valor)
 * @method static retornoAPI($status, $mensagem, $dados = null, $erros = null)
 *
 */
class UtilsFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'UtilsFacade'; }
}