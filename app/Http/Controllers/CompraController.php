<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Carritos;
use App\Producto;
use App\Compras;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class CompraController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $carritoPrevios =  DB::table('carritos')->join('productos', 'carritos.id_producto', '=', 'productos.id')
        ->select('carritos.*', 'carritos.id AS id_carrito', 'productos.*')
        ->where('carritos.id_usuario',auth()->user()->id)->get();
        
        foreach($carritoPrevios as $carritoPrevio){

        $compra =  new Compras;
        $compra->id_usuario = $carritoPrevio->id_usuario;
        $compra->id_producto = $carritoPrevio->id_producto;
        $compra->monto = ($carritoPrevio->precio * $carritoPrevio->cantidad);
        $compra->cantidad = $carritoPrevio->cantidad;        
        $hoy = getdate();
        $fechaActual =$hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
        $compra->fecha = $fechaActual;
        
        $product = Producto::find($carritoPrevio->id_producto);
        $idCarrito = $carritoPrevio->id_carrito;
        if ( $product->stock >= $carritoPrevio->cantidad ) {
                
                if ($compra->save()) {

                    Session::flash('message', 'Compras realizadas correctamente');
                    Session::flash('class', 'success');
                    
                    $product = Producto::find($carritoPrevio->id_producto);
                    $cantidadRestante = ($product->stock - $carritoPrevio->cantidad);
                    $product->stock = $cantidadRestante;
                    $product->save();
                    $carrito = Carritos::find($idCarrito);                    
                    $carrito->delete();
                    
                } else {
                    Session::flash('message', 'Ha ocurrido un error');
                    Session::flash('class', 'danger');
                }
        }else{

            Session::flash('message', 'Ha ocurrido un error, la cantidad solicitada no esta disponible.');
            Session::flash('class', 'danger');
            
        }

        }
        
        return Redirect::to('/cart');
    }
    public function paypal(){
        $id = auth()->user()->id;
        $usuarioLogeado = User::find($id);
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        $precioTotal = DB::table('carritos')->where('id_usuario',$id)->sum('precio');
        
        $carritosProductos =  DB::table('carritos')->join('productos', 'carritos.id_producto', '=', 'productos.id')
        ->select('carritos.*', 'carritos.id AS id_carrito', 'productos.*')
        ->where('carritos.id_usuario',$id)->get();
        //dd($carritosProductos);
        return view('paywithpaypal')->with('carritos', $carritos)
        ->with('usuarioLogeado', $usuarioLogeado)
        ->with('carritosProductos', $carritosProductos)
        ->with('precioTotal', $precioTotal);
        
        //return view('paywithpaypal');
    }
}
