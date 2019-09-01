<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jugos;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;

class JugosController extends Controller
{
    //
    public function crear(){
        $jugos = Jugos::all();
        return view('admin.jugos.crear', compact('jugos'));
    }

    // Proceso de Creación de un Registro 
 
    public function store(ItemCreateRequest $request){
        // Instancio al modelo Jugos que hace llamado a la tabla 'jugos' de la Base de Datos
        $jugos = new Jugos; 
    
        // Recibo todos los datos del formulario de la vista 'crear.blade.php'
        $jugos->nombre = $request->nombre;
        $jugos->precio = $request->precio;
        $jugos->stock = $request->stock;
        
        // Almacenos la imagen en la carpeta publica especifica, esto lo veremos más adelante 
        $jugos->img = $request->file('img')->store('/');
    
        // Inserto todos los datos en mi tabla 'jugos' 
        $jugos->save();
    
        // Hago una redirección a la vista principal con un mensaje 
        return redirect('admin/jugos')->with('message','Guardado Satisfactoriamente !');
    }

    // Leer Registros (Read) 
 
    public function index(){
        $jugos = Jugos::all();
        return view('admin.jugos.index', compact('jugos')); 
    }

    //  Actualizar un registro (Update)
 
    public function actualizar($id){
        $jugos = Jugos::find($id);
        return view('admin/jugos.actualizar',['jugos'=>$jugos]);
    }

    public function update(ItemUpdateRequest $request, $id){        
        // Recibo todos los datos desde el formulario Actualizar
        $jugos = Jugos::find($id);
        $jugos->nombre = $request->nombre;
        $jugos->precio = $request->precio;
        $jugos->stock = $request->stock;
    
        // Recibo la imagen desde el formulario Actualizar
        if ($request->hasFile('img')) {
            $jugos->img = $request->file('img')->store('/');
        }
        
        // Actualizo los datos en la tabla 'jugos'
        $jugos->save();
    
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('admin/jugos');
    }

    public function eliminar($id){
        // Indicamos el 'id' del registro que se va Eliminar
        $jugos = Jugos::find($id);
    
        // Elimino la imagen de la carpeta 'uploads', esto lo veremos más adelante
        $imagen = explode(",", $jugos->img);
        Storage::delete($imagen);
            
        // Elimino el registro de la tabla 'jugos' 
        Jugos::destroy($id);
            
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('admin/jugos');
    }
}
