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

<div class="row">
<br><br>
<div class="col-md-4 animated fadeIn fast">

  <img src="{{ $product->imagen }}" class="img-fluid" alt="{{ $product->imagen }}">
  <br><br>

</div>

<div class="col-md-8">
   <br><br>
   <h1> {{ $product->nombre }} </h1>
   <hr>
  <h3> Precio $ {{ $product->precio }} </h3>  
  <hr>
  <h2> SKU </h2>#{{ $product->sku }}
  <hr>
  <p>
        {{ $product->descripcion }}
  </p>      
  <a class="btn btn-outline-danger" href="/history" title = "Regresar al Historial" >Regresar</a>
  <br><br>

  </div>

</div>
</div>

@endif
