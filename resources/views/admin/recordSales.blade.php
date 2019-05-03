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

@if(Session::has('message'))
<div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
@endif

<div class="container">
  <br>
  <h1>Historial de Compras</h1>
  <hr>
  <table class="table table-hover table-bordered">
    <tr class="table-success">
      <th class="danger">Id</th>
      <th>ID Cliente</th>
      <th>Nombre Cliente</th>
      <th>Nombre Producto</th>
      <th>Descripcion Producto</th>
      <th>Cantidad Adquirida</th>
      <th>Precio Total Compra</th>
      <th>Fecha de la Compra</th>
    </tr>

    @if(count($comprasHistorial))
    @foreach($comprasHistorial as $compra)
    <tr>
    
    <td>{{ $compra->id_compra }}</td>
    <td>{{ $compra->uId }}</td>
    <td>{{ $compra->nombre_usuario .' '. $compra->apellido1.' '. $compra->apellido2 }}</td>
    <td>{{ $compra->nombre_producto }}</td>
    <td>{{ $compra->descripcion_producto }}</td>
    <td>{{ $compra->cantidad }}</td>
    <td>{{ $compra->monto }}</td>
    <td>{{ $compra->fecha }}</td>
    
    
   </tr>
    @endforeach
    @else
      <tr><td class="text-center" colspan=8>No hay datos para Mostrar</td></tr>
    @endif
  
  </table>
</div>

@endif