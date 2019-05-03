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

<div class="container">

    <br>
    <h1 class="" > {{ $usuarioLogeado->nombre .' '. $usuarioLogeado->apellido1 }} </h1>

    <table class="table table-hover table-bordered">
        <tr class="table-success">
        <th>Id</th>
        <th>SKU</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Imagen</th>
        <th>Cantidad Preordenada</th>
        <th>Precio Individual</th>
        <th class="text-center">Accion</th>
        </tr>

        @if(count($carritosProductos) > 0)

        @foreach($carritosProductos as $carritosProducto )

        <tr>
            <td>{{ $carritosProducto->id_carrito }}</td>
            <td>{{ $carritosProducto->sku }}</td>
            <td>{{ $carritosProducto->nombre }}</td>
            <td>{{ $carritosProducto->descripcion }}</td>
            <td><img src="{{ $carritosProducto->imagen }}"></td>
            <!--<td> <input type="number"  name="numberGame" id="cantidadProducto" min="1" max="99" value="1"> </td>-->
            <td>{{ $carritosProducto->cantidad }}</td>
            <td> $ {{ $carritosProducto->precio }}</td>
            <td>
                <a class="btn btn-danger" href="{{ url('/cart/destroy',$carritosProducto->id_carrito) }}" title="Eliminar Producto" id="eliminarProducto">Eliminar Producto</a>   
            </td>
        </tr>
        @endforeach
        <tr>
            <td class='text-center' colspan=3>Precio Total del Carrito:</td>
            <td class='text-center' colspan=3> $ {{ $precioTotal }}</td>
            
            <td class='text-center' colspan=2> 
            
            <form method="POST" action="{{ url('/buy/store') }}">
                <input class="btn btn-outline-success" title = "Comprar todo" type="submit" value="Chekout">
            </form>

            <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
                action="{!! URL::to('paypal') !!}">
                {{ csrf_field() }}
                <input class="w3-input w3-border" id="amount" type="text" name="amount" hidden="Total" readonly="readonly" value=" {{ $precioTotal }}"></p>
                <input class="btn btn-outline-success" title = "Comprar todo" type="submit" value="Paypal">
    	    </form>
            
            </td>
           
        </tr>
           
        @else
        <tr><td class="text-center" colspan=8>No hay informacion disponible</td></tr>
        @endif

    </table>

</div>

@endif
