<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'http://127.0.0.1:2000/api/products';
        $response = file_get_contents($url);
        $products = json_decode($response);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categoria::orderBy('id', 'ASC')->get();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banderaSKU = DB::table('productos')->where('sku',Input::get('sku'))->exists();

        if (!$banderaSKU) {
            $file = $request->file('imagen');
            $name = 'product_' . time() . '.' . $file->getClientOriginalExtension();
            $path =  public_path() . '\\images_products\\';
            $file->move($path, $name);
            $finalPath = '\\images_products\\'. $name ;
        
            $product = new Producto;
            $product->nombre = Input::get('nombre');
            $product->descripcion = Input::get('descripcion');
        
            $product->imagen = $finalPath;
            $product->categoria_id = Input::get('categoriaPadre');
            $product->stock = Input::get('stock');
            $product->precio = Input::get('precio');
            $product->sku = Input::get('sku');
        
            
            if ($product->save()) {
                Session::flash('message', 'Producto guardado correctamente');
                Session::flash('class', 'success');
            } else {
                Session::flash('message', 'Ha ocurrido un error');
                Session::flash('class', 'danger');
            }
            return Redirect::to('products/index');
        }
        else{
            Session::flash('message', 'Ha ocurrido un error, SKU ya en uso');
            Session::flash('class', 'danger');

            return Redirect::to('products/create');            
        }
        
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
        $product = Producto::find($id);
        $categories = Categoria::orderBy('id', 'ASC')->get();
        return view('products.edit')->with('categories', $categories)
        ->with('product', $product)
        ->with('imagenActual', $product->imagen);
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
        $file = $request->file('imagen');
        $productOriginal = Producto::find($id);
        $imagenOriginal = $productOriginal->imagen;

        if(!$file){
            
            $product = Producto::find($id);
            $product->nombre = Input::get('nombre');
            $product->descripcion = Input::get('descripcion');
            $product->imagen = $imagenOriginal;
            $product->categoria_id = Input::get('categoriaPadre');
            $product->stock = Input::get('stock');
            $product->precio = Input::get('precio');
            $product->sku = Input::get('sku');

            if ($product->save()) {
                Session::flash('message', 'Producto actualizado correctamente');
                Session::flash('class', 'success');
            } else {
                Session::flash('message', 'Ha ocurrido un error');
                Session::flash('class', 'danger');
            }
            return Redirect::to('products/index');
        
        }
        else
        {
            $name = 'product_' . time() . '.' . $file->getClientOriginalExtension();
            $path =  public_path() . '\\images_products\\';
            $file->move($path, $name);
            $finalPath = '\\images_products\\'. $name ;

            //borrando la antigua imagen
            unlink(public_path() . $imagenOriginal);

            $product = Producto::find($id);
            $product->nombre = Input::get('nombre');
            $product->descripcion = Input::get('descripcion');
            $product->imagen = $finalPath;
            $product->categoria_id = Input::get('categoriaPadre');
            $product->stock = Input::get('stock');
            $product->precio = Input::get('precio');
            $product->sku = Input::get('sku');
            
            if ($product->save()) {
                Session::flash('message', 'Producto actualizado correctamente');
                Session::flash('class', 'success');
            } else {
                Session::flash('message', 'Ha ocurrido un error');
                Session::flash('class', 'danger');
            
            
            }
            return Redirect::to('products/index');
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
        $product = Producto::find($id);
        $imagen = $product->imagen;
        unlink(public_path() . $imagen);

        if ($product->delete()) {

            Session::flash('message', 'Producto eliminado correctamente');
            Session::flash('class', 'success');
        } else {
            Session::flash('message', 'Ha ocurrido un error');
            Session::flash('class', 'danger');
        }
        return Redirect::to('products/index');
    }

    public function detailProduct($id) {
     
        $product = Producto::find($id);
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        return view('client.detail_product')->with('product', $product)
        ->with('carritos', $carritos);
    }
}
