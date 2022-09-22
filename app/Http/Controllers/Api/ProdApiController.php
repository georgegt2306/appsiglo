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
            return response()->json(["sms"=>true, "data"=>["cod_producto"=>$result->cod_producto, "nombre"=>$result->nombre, "valor"=>$result->valor_premio]]);
        }else{
            return response()->json(["sms"=>false,"data"=>"Codigo no existente"]);
        }
       
    }

    
    public function totalproduct(Request $request)
    {

        $filtros=[];
        
        
        if(strcmp($request->marca,'')!=0){
            array_push($filtros, ['marca','=',$request->marca]);
        }
        if(strcmp($request->NombreNivel1,'')!=0){
            array_push($filtros, ['NombreNivel1','=',$request->NombreNivel1]);
        }
        if(strcmp($request->NombreNivel2,'')!=0){
            array_push($filtros, ['NombreNivel2','=',$request->NombreNivel2]);
        }
        if(strcmp($request->NombreNivel3,'')!=0){
            array_push($filtros, ['NombreNivel3','=',$request->NombreNivel3]);
        }       
        if(strcmp($request->descripcion,'')!=0){
            array_push($filtros, ['descripcion','LIKE', '%'.$request->descripcion.'%']);
        }
        
        
        



        $result= Producto::select('id', 'url_image', 'cod_producto', 'descripcion', 'valor_premio','vigencia')
        ->where($filtros)
        ->WhereNull('vigencia')->orWhere([['vigencia','>=', date('Y-m-d h:i:s')]])
        ->WhereNull('deleted_at')->paginate(30);

        return response()->json(["sms"=>true, "data"=>$result ]);
       
    }
}

