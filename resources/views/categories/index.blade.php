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
  <h1>Categorias</h1>
  <hr>
  <table class="table table-hover table-bordered">
    <tr class="table-success">
      <th class="danger">Id</th>
      <th>Nombre</th>
      <th>Categoria Padre</th>
      <th class="text-center">
        <a class="btn btn-success" href="/categories/create" title="Añadir Categoria">Añadir Categoria</a>
      </th>
    </tr>

    @if(count($categories))
    @foreach($categories as $categorie)
    <tr>
    
    <td>{{ $categorie->id }}</td>
    <td>{{ $categorie->nombre }}</td>
    <td>{{ $categorie->categoria_padre }}</td>
    <td>
    <a class="btn btn-warning" href="{{ url('/categories/edit',$categorie->id) }}" title="Editar Categoria">Editar</a>
    <a class="btn btn-danger" href="{{ url('/categories/destroy',$categorie->id) }}" title="Eliminar Categoria">Eliminar</a>
    </td>

   </tr>
    @endforeach
    @else
      <tr><td class="text-center" colspan=4>No hay datos para Mostrar</td></tr>
    @endif
  
  </table>
</div>

@endif