<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;

class ProdApiController extends Controller
{
    
    public function producto(Request $request)
    {

        $result=Producto::whereNull('deleted_at','id_local')
                ->orderBy('id')
                ->get();

        return response()->json(["sms"=>true,"data"=>$result]);
        
        // if(is_null($request->local)){
        //     try {
                
        //         return response()->json(["sms"=>true,"data"=>$result]);
        //     } catch(\Exception $e){
        //         return response()->json(["sms"=>false,"data"=>"Error en respuesta"]);
        //     }

        // }else{
        //     $result=Producto::whereNull('deleted_at')
        //     ->Where('id_local', $request->local)
        //     ->orderBy('id')
        //     ->get();

        //     if(count($result)>0){
        //         return response()->json(["sms"=>true,"data"=>$result]);
        //     }else{
        //         return response()->json(["sms"=>false,"data"=>"Error en respuesta"]);
        //     }

           
        // }
       
    }
}
