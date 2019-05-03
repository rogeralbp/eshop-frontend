@if( Auth::user()->tipo_usuario != "CL")

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

@include('security.headerClient')

    @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
    @endif

    <div class="container">
<br>
<h1 class="" > {{ $usuarioLogeado->nombre .' '. $usuarioLogeado->apellido1 }} </h1>
<hr>

  <style>
  
  #content{
	  display: flex;
	  justify-content: center;
	  margin: 20px;
  }
  
  img{
		width: 125px;
		height: 100px;
	}

	
  #mensaje {
	  max-width: 90%;
		max-height : 200px;
	}
  
  </style>

  <table class="table table-hover table-bordered">
    <tr class="table-success">
      <th>ID</th>
      <th>SKU </th>
      <th>Imagen</th>
      <th>Fecha</th>
      <th>Monto </th>
      <th>Cantidad </th>
      
      <th class="text-center">Accion</th>
    </tr>

    @if(count($comprasHistorial) > 0)

    @foreach($comprasHistorial as $compra )

    <tr>
        <td>{{ $compra->id_compra }}</td>
        <td>{{ $compra->sku }}</td>
        <td><img src="{{ $compra->imagen }}" ></td>
        <td>{{ $compra->fecha }}</td>
        <td>{{ $compra->monto }}</td>
        <td>{{ $compra->cantidad }}</td>
        <td><a class="btn btn-warning" href="{{ url('/products/detailProduct',$compra->id) }}" title= "Ver Detalles del Producto">Detalles Producto</a></td>

    </tr>            

    @endforeach           
    
    @else
    
        <tr><td class="text-center" colspan=7>No hay informacion disponible</td></tr>
    
    @endif


  </table>

</div>

@endif
