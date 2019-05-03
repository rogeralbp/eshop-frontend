<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Carritos;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class CarritoController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idProducto)
    {
        $cantidadSolicitada = Input::get('cantidadArticulo');
        $product = Producto::find($idProducto);
        $usuarioLogeado = User::find(auth()->user()->id);
        
        if ($product->stock >= $cantidadSolicitada ) {
            $carrito = new Carritos;
            $carrito->id_usuario = auth()->user()->id;
            $carrito->id_producto = $product->id;
            $carrito->cantidad = $cantidadSolicitada;
            $carrito->precio = ($product->precio * $cantidadSolicitada);
        
            //$cantidadRestante = ($product->stock - $carrito->cantidad);
            //$product->stock = $cantidadRestante;
            //$product->save();
        
            if ($carrito->save()) {
                Session::flash('message', 'Carrito añadido correctamente');
                Session::flash('class', 'success');
                
            } else {
                Session::flash('message', 'Ha ocurrido un error');
                Session::flash('class', 'danger');
            }
            return Redirect::to('/details/' . $idProducto );
        
        }else{
            Session::flash('message', 'Ha ocurrido un error, la cantidad solicitada no esta disponible.');
            Session::flash('class', 'danger');

            return Redirect::to('/details/' . $idProducto);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrito = Carritos::find($id);

        if ($carrito->delete()) {
            Session::flash('message', 'Carrito eliminado correctamente');
            Session::flash('class', 'success');
        } else {
            Session::flash('message', 'Ha ocurrido un error');
            Session::flash('class', 'danger');
        }

        return Redirect::to('/cart');
    }
}
