
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
  <h1><small>Catalogo Productos</small></h1>
  <br>
  <a class="btn btn-outline-danger" href="/home" title = "Regresar al Catalogo" >Regresar</a>
  <hr>
</div>

@if(count($productosInventario) > 0 )

    <div class="container main-container">
      <div class="card-columns">
    
    @foreach($productosInventario as $producto)    
   
        
          <div class="card animated fadeIn fast">
              <img class="card-img-top img-fluid" src="{{$producto->imagen}}" [alt]="{{$producto->nombre}}">    
              <div class="card-body">
                  <h5 class="card-title">{{$producto->nombre}}</h5>
                  <p class="card-text">{{$producto->descripcion}}</p>
                  <p class="card-text"><small class="text-muted"> Categoria {{$producto->nombre_categoria}} </small></p>
                  @if($producto->stock > 0 )
                    <a class="btn btn-outline-primary btn-block" href="/details/{{ $producto->id }}" title="Detalles del Producto">Detalles</a>
                  @else
                  <a class="btn btn-outline-primary btn-block" href="#" title="Producto con bajo stock.">Producto No disponible</a>
                  @endif
              </div>
          </div>

   
    
    @endforeach
      
      </div>
    </div>

@else
  <div class="container">
      <a href='#'class = 'list-group-item list-group-item-danger' title='Click para Ver Productos' >
        No hay productos disponibles
      </a>
      <br>
      <br>
  </div>
  
@endif


<div class="container main-container">
  <h2>Otras Categorias</h2>
  <hr>
  <div class="list-group">
  
    @if(count($categoriasHijas) > 0 )

      @foreach($categoriasHijas as $categoria)

    <a href='/explore/{{ $categoria->id }}'class = 'list-group-item list-group-item-danger' title='Ver Productos de esta categoria' >
     {{ $categoria->nombre }}
     
     </a>

      @endforeach

    @else

    <div class="container">
     <a href='#'class = 'list-group-item list-group-item-danger' title='Click para Ver Productos' >
      No hay categorias disponibles
     </a>
     <br>
      <br>
    </div>
   

    @endif

  </div>
</div>
<br>
<br>
<br>


@endif
