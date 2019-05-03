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
<form method="POST" action="store">

<div class="form-group">
  <label>Nombre:</label>
  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required value="">
</div>

<div class="form-group">
  <label>Categoria Padre (OPCIONAL) :</label>
  <select name="categoriaPadre" value="" required>
  <option value="NINGUNA">NINGUNA</option>
  @foreach($categories as $categorie)
  <option value="{{ $categorie->nombre }}">{{ $categorie->nombre }} </option>
  @endforeach
  
  </select><br><br>
</div>

<input id="guardarCategoria" class="btn btn-primary" type="submit" value="Aceptar">
<a class="btn btn-danger" href="/categories/index">Cancelar</a>
</form>

</div>

@endif