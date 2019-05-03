@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('contentA')

<div class="flex-container">

<div class="card buzz" style="width: 18rem;">
  <img class="card-img-top" src="\imgs\users.png" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Cantidad de Usuarios Registrados  {{ $cantidadUsuarios }}  </p>
  </div>
</div>

<div class="card wobble-vertical" style="width: 18rem;">
  <img class="card-img-top" src="\imgs\sales.jpg" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Cantidad de Productos Vendidos  {{ $cantidadProductosAdquiridos }}  </p>
  </div>
</div>

<div class="card shrink" style="width: 18rem;">
  <img class="card-img-top" src="\imgs\money.png" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Monto Total Recaudado $ {{ $montoCompras }} </p>
  </div>
</div>

</div>

@endsection

@section('contentC')

<div class="container">
  <h1><small>Categorias Productos</small></h1>

  <div class="list-group">
   
   @if(count($categories) > 0)
    
        @foreach($categories as $categorie)
            <a href='/explore/{{ $categorie->id }}'class = 'list-group-item list-group-item-action list-group-item-success' title='Click para Ver Productos' >
                {{ $categorie->nombre }}
            </a>
        @endforeach
    
    @else
        <a href='#'class = 'list-group-item list-group-item-danger' title='Productos No Existentes' >No hay categorias disponibles</a>
    @endif

   </div>   

</div>


@endsection

