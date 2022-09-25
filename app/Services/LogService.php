<?php


namespace App\Services\Log;
use App\Models\Log;
use Carbon\Carbon;

class LogService{


    public static function register($tipo, $sucesso, $mensagem){


        $data = Carbon::now(-3)->toDateTimeString();

        try {

            Log::create([
                'tipo' => $tipo,
                'data' => $data,
                'sucesso' => $sucesso,
                'mensagem' => $mensagem
            ]);
            
            return true;

        } catch (\Exception $ex) {
            return false;
        }
    }



}


?>