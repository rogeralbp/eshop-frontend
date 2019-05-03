@if(Auth::user()->tipo_usuario != "AD")
<div class="container">
  
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <style>
    table{
        font-family: arial, sans-serif;
        border-collapse:collapse;
        width:100%;

    }
    td , th{
        border:1px solid #dddddd;
        text-align:left;
        padding:8px;

    }

    tr:nth-child(even){
        background-color:#dddddd;

    }

    </style>
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
  <h1>Historial de Compras Puerto Cel</h1>
  <hr>
  <table class="table table-hover table-bordered">
    <tr class="table-success">
      <th class="danger">Id</th>
      <th>ID Cliente</th>
      <th>Nombre Cliente</th>
      <th>Apellido 1</th>
      <th>Apellido 2</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Direccion</th>
    </tr>

    @if(count($users))
    @foreach($users as $u)
    <tr>
    
   
    <td>{{ $u->id }}</td>
    <td>{{ $u->nombre }}</td>
    <td>{{ $u->apellido1  }}</td>
    <td>{{ $u->apellido2 }}</td>
    <td>{{ $u->telefono }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->direccion }}</td>
    
    
    
   </tr>
    @endforeach
    @else
      <tr><td class="text-center" colspan=8>No hay datos para Mostrar</td></tr>
    @endif
  
  </table>
</div>

@endif