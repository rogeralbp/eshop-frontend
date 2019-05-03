<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'http://127.0.0.1:2000/api/categories';
        $response = file_get_contents($url);
        $categories = json_decode($response);
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categoria::orderBy('id', 'ASC')->get();
        return view('categories.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria;
        $categoria->nombre = Input::get('nombre');
        $categoria->categoria_padre = Input::get('categoriaPadre');
        
        if ($categoria->save()) {
            Session::flash('message', 'Categoria guardada correctamente');
            Session::flash('class', 'success');
        }
        else{
            Session::flash('message', 'Ha ocurrido un error');
            Session::flash('class', 'danger');
        }
        return Redirect::to('categories/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        //$categories = Categoria::orderBy('id', 'ASC')->get();
        return view('categories.edit')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        $categoria->nombre = Input::get('nombre');
        $categoria->categoria_padre = Input::get('categoriaPadre');

        if ($categoria->save()) {
            Session::flash('message', 'Categoria actualizada correctamente');
            Session::flash('class', 'success');
        }
        else{
            Session::flash('message', 'Ha ocurrido un error');
            Session::flash('class', 'danger');
        }
        return Redirect::to('categories/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $categoria = Categoria::find($id);
        $bandera = DB::table('categorias')->where('categoria_padre', $categoria->nombre )->exists();
        $bandera2 =  DB::table('productos')->where('categoria_id', $categoria->id )->exists();
         
        if(!$bandera){
            
            if(!$bandera2){
                
                if ($categoria->delete()) {
                    Session::flash('message', 'Categoria eliminada correctamente.');
                    Session::flash('class', 'success');
                } else {
                    Session::flash('message', 'Ha ocurrido un error');
                    Session::flash('class', 'danger');
                }
                return Redirect::to('categories/index');
            }else{
                Session::flash('message', 'Existen productos que dependen de esta Categoria.');
                Session::flash('class', 'danger');
            }

            return Redirect::to('categories/index');
        
        }else{
            Session::flash('message', 'No es posible eliminar una Categoria padre.');
            Session::flash('class', 'danger');
        }

        return Redirect::to('categories/index');
    }
}
