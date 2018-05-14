<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ExtratorController extends Controller
{
    public function PRO(){
        $FB = DB::connection('firebird')->table('PRO')->select('ID_ATO','PROTOCOLO',
                                                                'REGISTRO',
                                                                'DATAPROTOCOLO',
                                                                'DATAREGISTRO',
                                                                'DESCRICAONATUREZA',
                                                                'EMPRESA',
                                                                'CNPJ'
                                                                )->get();
        $cont = 0;                                                        
        foreach($FB as $linha){
        
            try{
                DB::connection('mysql')->table('090167_PRO')->insert(
                    ['ID_ATO'=> $linha->ID_ATO,
                    'PROTOCOLO' => $linha->PROTOCOLO,
                    'REGISTRO' => $linha->REGISTRO,
                    'DATAPROTOCOLO' => $linha->DATAPROTOCOLO,
                    'DATAREGISTRO' => $linha->DATAREGISTRO,
                    'DESCRICAONATUREZA' => $linha->DESCRICAONATUREZA,
                    'EMPRESA' => $linha->EMPRESA,
                    'CNPJ' => $linha->CNPJ,
                ]);
                }catch(Exception $e){
                    return 'ERROR'.$e;  
                }
                $cont ++;                
        }
        return ['Resultados' => $cont];
        
    }

    public function PESSOAS(){
        $FB = DB::connection('firebird')->table('PESSOAS')->select('ID_PESSOA',
                                                                    'NOME',
                                                                    'LOGRADOURO',
                                                                    'ENDERECO',
                                                                    'BAIRRO',
                                                                    'CIDADE',
                                                                    'UF',
                                                                    'CEP',
                                                                    'DOCUMENTO',
                                                                    'TIPO_PESSOA',
                                                                    'FICHA')->get();
        $cont = 0;
        foreach($FB as $linha){
        try{
            DB::connection('mysql')->table('090167_PESSOAS')->insertGetId(
                ['ID_PESSOA'=> $linha->ID_PESSOA,
                'NOME'=> $linha->NOME,
                'LOGRADOURO' => $linha->LOGRADOURO,
                'ENDERECO' => $linha->ENDERECO,
                'BAIRRO' => $linha->BAIRRO,
                'CIDADE' => $linha->CIDADE,
                'UF' => $linha->UF,
                'CEP' => $linha->CEP,
                'DOCUMENTO' => $linha->DOCUMENTO,
                'TIPO_PESSOA' => $linha->TIPO_PESSOA,
                'FICHA' => $linha->FICHA,
                ]);
        }catch(Exception $e){
            return 'ERROR'.$e;
        }
       $cont++;
        
        }
        return ['Resultados' => $cont];
    }
    public function NOM(){
        $FB = DB::connection('firebird')->table('NOM')->select('COD',
                                                                    'ID_ATO',
                                                                    'PROTOCOLO',
                                                                    'REGISTRO',
                                                                    'NOME',
                                                                    'CGC',
                                                                    'TP_PESSOA',
                                                                    'FICHA')->get();
        $cont = 0;
        foreach($FB as $linha){
        try{
            DB::connection('mysql')->table('090167_NOM')->insertGetId(
                ['ID_ATO'=> $linha->ID_ATO,
                'PROTOCOLO'=> $linha->PROTOCOLO,
                'COD' => $linha->COD,
                'REGISTRO' => $linha->REGISTRO,
                'NOME' => $linha->NOME,
                'CGC' => $linha->CGC,
                'TP_PESSOA' => $linha->TP_PESSOA,
                'FICHA' => $linha->FICHA,
                ]);
        }catch(Exception $e){
            return 'ERROR'.$e;
        }
       $cont++;
        
        }
        return ['Resultados' => $cont];
    }
}
