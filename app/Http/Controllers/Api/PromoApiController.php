<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promocion;

class PromoApiController extends Controller
{
    
    public function promo(Request $request)
    {

        if(!is_null($request->local)){

            $result=Promocion::whereNull('deleted_at')
                ->whereNull('id_local')
                ->orderBy('id')
                ->get();
        
        
            $result2=Promocion::whereNull('deleted_at')
                ->Where('id_local', $request->local)
                ->orderBy('id')
                ->get();

            if(count($result2)<1){
                $result2=null;
            }

            return response()->json(["sms"=>true,"promos"=>$result, "mispromos"=>$result2]);
        }else{
            return response()->json(["sms"=>false,"mensaje"=>"Agregue Local"]);
        }

        

       
    }
}
