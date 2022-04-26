<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\Producto;
use Validator;
use Input;

class ProductoController extends Controller
{
    public function index(){

       

         return view('Producto.index');
    }

    public function consulta_data(){
        $userid = \Auth::id();


          $result=Producto::whereNull('deleted_at')
                ->orderBy('id')
                ->get();
      

          $titulos = [];
          $titulos[] = array('title' => '');
          $titulos[] = array('title' => 'Acciones');
          $titulos[] = array('title' => 'Cod_producto');
          $titulos[] = array('title' => 'Nombre');
          $titulos[] = array('title' => 'Descripción');
          $titulos[] = array('title' => 'Valor_premio');

          $jsonenv=[];
      
        foreach ($result as $res) {

  
         $boton_up=' <button  title="editar" class="btn btn-success" name="editar" onclick="mostrarmodal('.$res->id.');"><i class="fa fa-edit"></i> </button>';
    
         $boton_elim=' <button title="eliminar" class="btn btn-danger" name="eliminar" onclick="elim('.$res->id.');"><i class="fa fa-trash"></i> </button>';

   
         $button= $boton_up.''.$boton_elim;

         $jsonenvtemp = ['',$button,$res->cod_producto,$res->nombre,$res->descripcion,$res->valor_premio];

          array_push($jsonenv, $jsonenvtemp);
        }

       return response()->json(["sms"=> $jsonenv, "titulos"=>$titulos]);   
   }

    public function store(Request $request){
        $userid = \Auth::id();
        
        try {
            DB::beginTransaction();

            Producto::create(
            [ 'cod_producto'=>$request->cod_producto,
              'nombre'=>$request->nombre,
              'descripcion'=>$request->descripcion,              
              'valor_premio'=>$request->valor_premio,
              'updated_at' =>now(),
              'created_at' =>now(),
              'user_updated' => $userid

            ]);
            


            DB::commit();
                
            return response()->json(["sms"=>true,"mensaje"=>"Se creo correctamente"]);                    
        }catch(\Exception $e){

            DB::rollBack();
            return response()->json(["sms"=>false,"mensaje"=>$e->getMessage()]);                 
        }
    }

    public function consultar($id){
       $trae_prod=Producto::join('categoria','producto.id_categoria','=','categoria.id')
                          ->select('producto.*', 'categoria.nombre as nombrecate')
                          ->where('producto.id', $id)->first();

       return view("Producto.consultar", compact('trae_prod'));
    }

    public function edit($id){
        $result_edit=Producto::where('id',$id)->first();      
       
        return view('Producto.edit', compact('result_edit'));
    }

    public function update(Request $request){
        $userid = \Auth::id(); 
        $path=$request->imagenanterior;

        if($archivo=$request->file('imagen_edit')){
            if(file_exists('images/productos/'.$request->idunic.'.png')){
                unlink('images/productos/'.$request->idunic.'.png'); 
            } 
            $path= asset('images/productos/'.$request->idunic.'.png');
            $archivo->move('images/productos', $request->idunic.'.png');
        } 

        if($request->url_edit != ''){
            if(file_exists('images/productos/'.$request->idunic.'.png')){
                unlink('images/productos/'.$request->idunic.'.png'); 
            } 
            $path=$request->url_edit;
        }

        try {
          DB::beginTransaction();
         
          $cons_insp_cab= Producto::where('id', '=', $request->idunic)
          ->update(['updated_at' =>now(), 
              'nombre'=>$request->nombre_edit,
              'descripcion'=>$request->descripcion_edit,
              'costo'=>$request->costo_edit,
              'precio'=>$request->precio_edit,
              'unidad'=>$request->unidad_edit,
              'existencia'=>$request->existencia_edit,
              'descuento'=>$request->descuento_edit,
              'tasa_iva'=>$request->iva_edit,
              'url_imagen' =>$path==null?'https://pasarelamercy.online/images/producto.png':$path,
              'user_updated' => $userid]);

            DB::commit();
                
            return response()->json(["sms"=>true,"mensaje"=>"Se edito correctamente"]);                

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(["sms"=>false,"mensaje"=>$e->getMessage()]);                 
        }
    }
    public function destroy($id){
        $userid = \Auth::id(); 
        try {

            DB::beginTransaction();

                Producto::where('id', $id)->update([
                   'updated_at' =>now(),
                   'deleted_at' =>now(),
                   'user_updated' => $userid
                ]);

            DB::commit();
        
            return response()->json(["sms"=>true,"mensaje"=>"Se elimino correctamente"]);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(["sms"=>false,"mensaje"=>$e->getMessage()]);                 
      }
    }

}
