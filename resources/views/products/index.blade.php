
@if(Auth::user()->tipo_usuario != "AD")

<div class="container">
  
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  
  <body>
    <h5 class="card-title">No tienes permiso para entrar en esta página</h5>
      <a href="/home" class="btn btn-primary">Volver</a>
  </body>
    
</div>

@else

@include('security.headerAdmin')

<style>

img{
		width: 125px;
		height: 100px;
	}
</style>
<div class="container">
    <h1>Productos</h1>
    <hr>
    <table class="table table-hover table-bordered">
      <tr class="table-success">
        <th>Id</th>
        <th>SKU</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Imagen</th>
        <th>Categoria</th>
        <th>Stock</th>
        <th>Precio</th>
        <th class="text-center">
          <a class="btn btn-success" href="/products/create" title="Añadir Producto">Añadir Producto</a>
        </th>
      </tr>
      
        @if(count($products))
        @foreach($products as $product)

        <tr>
        
        <td>{{$product->id}}</td>
        <td>{{$product->sku}}</td>
        <td>{{$product->nombre}}</td>
        <td>{{$product->descripcion}}</td>
        <td><img src="{{ $product->imagen }}"></td>
        <td>{{$product->nombre_categoria}}</td>
        <td>{{$product->stock}}</td>
        <td>{{$product->precio}}</td>
        <td>
            <a class="btn btn-warning" href="{{ url('/products/edit',$product->id) }}" title="Editar Producto" >Editar</a>
            <a class="btn btn-danger" href="{{ url('/products/destroy',$product->id) }}" title="Eliminar Producto">Eliminar</a>
        </td>
        </tr>
        
        @endforeach
        @else
        <tr><td class="text-center" colspan=9>No hay datos para Mostrar</td></tr>
        @endif
        

    </table>
</div>
@endif