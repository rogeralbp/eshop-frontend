<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Compras;
use App\Carritos;
use App\Categoria;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'http://127.0.0.1:2000/api/home/index/'.auth()->user()->id;
        $response = file_get_contents($url);
        $homePage = json_decode($response);
        
        $categories = $homePage->categories;
        $usuarios =  $homePage->cantidadUsuarios;
        $productos =  $homePage->cantidadProductosAdquiridos;
        $compras = $homePage->montoCompras;
        $carritos = $homePage->carritos;
        
        return view('home')->with('cantidadUsuarios', $usuarios)
        ->with('cantidadProductosAdquiridos', $productos)
        ->with('montoCompras', $compras)
        ->with('carritos', $carritos)
        ->with('categories', $categories);
    }

    public function estadistics()
    {
        $id = auth()->user()->id;
        $compra = Compras::find($id);
        $productosAdquiridos =  DB::table('compras')->where('id_usuario',$id)->count();
        $montoTotal = DB::table('compras')->where('id_usuario',$id)->sum('monto');
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        return view('client.estadistics')->with('productosAdquiridos', $productosAdquiridos)
        ->with('montoTotal', $montoTotal)
        ->with('compra', $id)
        ->with('carritos', $carritos);
    }

    public function cart(){

        $id = auth()->user()->id;
        $usuarioLogeado = User::find($id);
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        $precioTotal = DB::table('carritos')->where('id_usuario',$id)->sum('precio');
        
        $carritosProductos =  DB::table('carritos')->join('productos', 'carritos.id_producto', '=', 'productos.id')
        ->select('carritos.*', 'carritos.id AS id_carrito', 'productos.*')
        ->where('carritos.id_usuario',$id)->get();
        //dd($carritosProductos);
        return view('client.cart')->with('carritos', $carritos)
        ->with('usuarioLogeado', $usuarioLogeado)
        ->with('carritosProductos', $carritosProductos)
        ->with('precioTotal', $precioTotal);
    }

    public function explore($idC){

        $id = auth()->user()->id;
        $usuarioLogeado = User::find($id);
        $categoria = Categoria::find($idC);
        $categories = Categoria::orderBy('id', 'ASC')->get();
        $productosInventario = DB::table('productos')->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombre AS nombre_categoria')
        ->where('categorias.id', $idC )
        //->where('productos.stock', '>',  0 )
        ->get();;
        $categoriasHijas = DB::table('categorias')->where('categoria_padre',$categoria->nombre)->get();
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        return view('client.explore')->with('carritos', $carritos)
        ->with('categories', $categories)
        ->with('productosInventario', $productosInventario)
        ->with('categoriasHijas', $categoriasHijas);
    }

    public function history(){

        $id = auth()->user()->id;
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        $usuarioLogeado = User::find(auth()->user()->id);
        $comprasHistorial = DB::table('compras')->join('productos', 'compras.id_producto', '=', 'productos.id')
        ->select('compras.*','productos.*','compras.id AS id_compra')
        ->where('id_usuario',$id)
        ->get();
        return view('client.history')->with('comprasHistorial', $comprasHistorial)
        ->with('carritos', $carritos)
        ->with('usuarioLogeado', $usuarioLogeado);
    }

    public function details($idProducto){
        
        $usuarioLogeado = User::find(auth()->user()->id);
        $product = Producto::find($idProducto);
        $id = auth()->user()->id;
        $carritos = DB::table('carritos')->where('id_usuario',$id)->count();
        return view('client.details')->with('carritos', $carritos)
        ->with('product', $product);
    }

    public function recordSales(){

        $comprasHistorial = DB::table('compras')
        ->join('productos', 'compras.id_producto', '=', 'productos.id')
        ->join('users', 'compras.id_usuario', '=', 'users.id')
        ->select('compras.*','productos.*','productos.nombre AS nombre_producto','productos.descripcion AS descripcion_producto','users.*','users.id AS uId','users.nombre AS nombre_usuario','compras.id AS id_compra')
        ->get();

        return view('admin.recordSales')->with('comprasHistorial', $comprasHistorial);
    }


    public function generar(){

        $users = DB::table('users')
        ->select(['id','nombre','apellido1','apellido2','telefono','email','direccion'])
        ->get();
        $view= \View::make('reportes' , compact('users'))->render();
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');

        //return view('admin.recordSales')->with('comprasHistorial', $comprasHistorial);
    }
    public function imprimir(){
        $comprasHistorial = DB::table('compras')
        ->join('productos', 'compras.id_producto', '=', 'productos.id')
        ->join('users', 'compras.id_usuario', '=', 'users.id')
        ->select('compras.*','productos.*','productos.nombre AS nombre_producto','productos.descripcion AS descripcion_producto','users.*','users.id AS uId','users.nombre AS nombre_usuario','compras.id AS id_compra')
        ->get();
        //$today = Carbon::now()->format('d/m/Y');
        $pdf = \PDF::loadView('reportes');
        return $pdf->download('ejemplo.pdf');
}
        
   }



