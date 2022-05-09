<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use Hash;
use Session;
use Validator;
use Auth;


class LoginController extends Controller
{
    public function credencial(Request $request)
    {
          
        $result=Vendedor::where('email', $request->email)
          ->whereNull('deleted_at')
          ->first();

       
        if (is_null($result)) {
          return response()->json(["sms"=>false,"mensaje"=>"Credenciales invalidas"]);
        } else{

               
                if (password_verify($request->password,$result->password)) {
                     
                      return response()->json(["sms"=>true,"mensaje"=>"Ingreso Correcto"]);
                }else{
                  return response()->json(["sms"=>false,"mensaje"=>"Credenciales invalidas"]);
                }

        }
    }
}
