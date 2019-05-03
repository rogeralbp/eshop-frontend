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

<body>

    <style>

    .flex-container {
        display: flex;
        justify-content: center; 
    }
    
    .flex-container > div {
        background-color: #f1f1f1;
        width: 100px;
        margin: 10px;
        text-align: center;
        line-height: 75px;
        font-size: 30px;
    }
   
  /* Wobble To Top Right */
  @-webkit-keyframes wobble-to-top-right {
    16.65% {
      -webkit-transform: translate(8px, -8px);
      transform: translate(8px, -8px);
    }
  
    33.3% {
      -webkit-transform: translate(-6px, 6px);
      transform: translate(-6px, 6px);
    }
  
    49.95% {
      -webkit-transform: translate(4px, -4px);
      transform: translate(4px, -4px);
    }
  
    66.6% {
      -webkit-transform: translate(-2px, 2px);
      transform: translate(-2px, 2px);
    }
  
    83.25% {
      -webkit-transform: translate(1px, -1px);
      transform: translate(1px, -1px);
    }
  
    100% {
      -webkit-transform: translate(0, 0);
      transform: translate(0, 0);
    }
  }
  
  @keyframes wobble-to-top-right {
    16.65% {
      -webkit-transform: translate(8px, -8px);
      transform: translate(8px, -8px);
    }
  
    33.3% {
      -webkit-transform: translate(-6px, 6px);
      transform: translate(-6px, 6px);
    }
  
    49.95% {
      -webkit-transform: translate(4px, -4px);
      transform: translate(4px, -4px);
    }
  
    66.6% {
      -webkit-transform: translate(-2px, 2px);
      transform: translate(-2px, 2px);
    }
  
    83.25% {
      -webkit-transform: translate(1px, -1px);
      transform: translate(1px, -1px);
    }
  
    100% {
      -webkit-transform: translate(0, 0);
      transform: translate(0, 0);
    }
  }
  
  .wobble-to-top-right {
    display: inline-block;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  }
  .wobble-to-top-right:hover, .wobble-to-top-right:focus, .wobble-to-top-right:active {
    -webkit-animation-name: wobble-to-top-right;
    animation-name: wobble-to-top-right;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    -webkit-animation-iteration-count: 1;
    animation-iteration-count: 1;
  }
  
  /* Wobble Skew */
  @-webkit-keyframes wobble-skew {
    16.65% {
      -webkit-transform: skew(-12deg);
      transform: skew(-12deg);
    }
  
    33.3% {
      -webkit-transform: skew(10deg);
      transform: skew(10deg);
    }
  
    49.95% {
      -webkit-transform: skew(-6deg);
      transform: skew(-6deg);
    }
  
    66.6% {
      -webkit-transform: skew(4deg);
      transform: skew(4deg);
    }
  
    83.25% {
      -webkit-transform: skew(-2deg);
      transform: skew(-2deg);
    }
  
    100% {
      -webkit-transform: skew(0);
      transform: skew(0);
    }
  }
  
  @keyframes wobble-skew {
    16.65% {
      -webkit-transform: skew(-12deg);
      transform: skew(-12deg);
    }
  
    33.3% {
      -webkit-transform: skew(10deg);
      transform: skew(10deg);
    }
  
    49.95% {
      -webkit-transform: skew(-6deg);
      transform: skew(-6deg);
    }
  
    66.6% {
      -webkit-transform: skew(4deg);
      transform: skew(4deg);
    }
  
    83.25% {
      -webkit-transform: skew(-2deg);
      transform: skew(-2deg);
    }
  
    100% {
      -webkit-transform: skew(0);
      transform: skew(0);
    }
  }
  
  .wobble-skew {
    display: inline-block;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  }
  .wobble-skew:hover, .wobble-skew:focus, .wobble-skew:active {
    -webkit-animation-name: wobble-skew;
    animation-name: wobble-skew;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    -webkit-animation-iteration-count: 1;
    animation-iteration-count: 1;
  }

    </style>

    <div id="app">
        
        @include('security.headerClient')
        <main class="py-4">
        
            <div class="flex-container">

            <div class="card  wobble-to-top-right" style="width: 18rem;">
                <img class="card-img-top" src="\imgs\products.jpg" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">Productos Adquiridos {{ $productosAdquiridos }}</p>
                </div>
            </div>

            <div class="card wobble-skew" style="width: 18rem;">
                <img class="card-img-top" src="\imgs\money.png" alt="Card image cap">
                <div class="card-body">
                <p class="card-text">Monto Total Compras ${{ $montoTotal }}</p>
                </div>
            </div>
            </div>

        </main>
    </div>
</body>
@endif
