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

<h1 class="animated fadeIn" > {{$product->nombre}} , {{$product->categoria_id}} </small> </h1>
<hr>

<div class="row">

    <div class="col-md-4 animated fadeIn fast">

      <img src="{{$product->imagen}}" class="img-fluid" alt="">
      <br><br>

    </div>

    <div class="col-md-8">

      <h3> Precio Actual </h3> {{$product->precio}}
      <hr>
      <h2> SKU </h2> {{$product->sku}}
      <hr>
      <h2>Descripcion Actual</h2>
      <p>
      {{$product->descripcion}}
      </p>
      <hr>
      <h3> Stock Actual </h3> {{$product->stock}}
      <hr>
      </div>

</div>


@if (!empty($product))

<form method="POST" enctype="multipart/form-data" action="/products/update/{{ $product->id }}">
  
<div class="form-group">
    <label>SKU:</label>
    <input type="text" class="form-control" name="sku" placeholder="SKU" value="{{$product->sku}}" required>
  </div>
  

  <div class="form-group">
    <label>Nombre:</label>
    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{$product->nombre}}" required>
  </div>

   <div class="col-12 col-md-6 mb-3">
		<label for="mensaje">Nueva Descripcion :</label>
		<textarea name="descripcion" id="mensaje" class="form-control">{{$product->descripcion}}</textarea>
   </div>

  <div class="form-group">
    <label>Imagen:</label>
    <div class="custom-file">
		  <input type="file" name="imagen" value="{{$product->imagen}}">
	  </div>
 </div>

  <div class="form-group">
    <label>Categoria :</label>
    <select name="categoriaPadre"  required>
    
    @foreach($categories as $categorie)
    <option value="{{$categorie->id}}">{{$categorie->nombre}}</option>
    @endforeach
    </select>
    <br><br>
  </div>
  
  <div class="form-group">
    <label>Stock :</label>
    <input type="number" class="form-control" name="stock" placeholder="stock"  value="{{$product->stock}}" min="1" max="1000000" required>
  </div>

  <div class="form-group">
    <label>Precio :</label>
    <div class="input-group-prepend">
    <span class="input-group-text">$</span>
    </div>
    <input type="number" class="form-control" name="precio" placeholder="precio"  value="{{$product->precio}}" min="1" max="1000000" required>
  </div>


  <input id ="guardarProducto" class="btn btn-primary" type="submit" value="Aceptar">
  <a class="btn btn-danger" href="/products/index">Cancelar</a>

  @else
    <p>
        No existe información para éste para este Producto.
    </p>
  @endif


  <br>
  <br>

</form>
</div>

@endif
