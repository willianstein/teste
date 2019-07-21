<?php
/**
 * Created by PhpStorm.
 * User: NASSARTI13
 * Date: 27/03/2019
 * Time: 09:09
 */

namespace App\Teste\Helpers;
use Illuminate\Support\Facades\Response;

class Utils
{


    function retornoAPI($status, $mensagem, $dados = null, $erros = null){
        $retorno = [
            'status' => $status,
            'mensagem' => $mensagem
        ];
        if(!is_null($dados)){
            $retorno['dados'] = $dados;
        }

        if(!is_null($erros)){
            $retorno['erros'] = $erros;
        }

        return Response::json($retorno);
    }
    static function soNumero($valor)
    {
        return $obj = preg_replace("/[^0-9]/", "", $valor);
    }
     static function validarToken($token)
     {
          $validar = self::find_by_token($token);

          if(!is_null($validar))
          {
              return back();
          }

     }

}