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

<div class="container">

<div class="panel-heading">
	<h4>Editar Categoria</h4>
</div>

  @if(Session::has('message'))
  <div class="alert alert-{{ Session::get('class') }}">{{ Session::get('message')}}</div>
  @endif

@if (!empty($categoria))

<form method="POST" action="/categories/update/{{ $categoria->id }}">

<div class="form-group">
  <label>Nombre:</label>
  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required value="{{ $categoria->nombre }}">
</div>

<div class="form-group">
  <label>Categoria Padre (OPCIONAL) :</label>
  <select name="categoriaPadre" value="" required>
  <option value="{{ $categoria->categoria_padre }}">{{ $categoria->categoria_padre }}</option>
  <option value="NINGUNA">NINGUNA</option>
  </select>
  <br><br>
</div>
<input id="guardarCategoria" class="btn btn-primary" type="submit" value="Aceptar">
<a class="btn btn-danger" href="/categories/index">Cancelar</a>

@else
    <p>
        No existe información para éste para la Categoria.
    </p>
@endif

</form>

</div>

@endif