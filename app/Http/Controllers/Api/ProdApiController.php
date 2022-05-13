<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;

class ProdApiController extends Controller
{
    
    public function producto(Request $request)
    {
        
        $result=Producto::where('cod_producto',$request->cod_producto)
                ->whereNull('deleted_at')
                ->orderBy('id')
                ->first();

        if(!is_null($result)){
            return response()->json(["sms"=>true,"data"=>$result->valor_premio]);
        }else{
            return response()->json(["sms"=>false,"data"=>"Codigo no existente"]);
        }
        
        

       
    }
}
