<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, productos-scalable=no, initial-scale=1.0">
    <title>Notificacion Producto Bajo STOCK</title>
</head>
<body>
    <p>Notificacion de Productos con bajo STOCK, pendientes de Actualizar</p>
    
	@if(count($productos) > 0)
            @foreach($productos as $producto)
			<ul>
                <p>---------------------------------------</p>
                
				<li>SKU: {{ $producto->sku }}</li>
                <li>Nombre: {{ $producto->nombre }}</li>
                <li>Stock Actual: {{ $producto->stock }}</li>
                
                <p>---------------------------------------</p>
                
			</ul>
            @endforeach
    @endif
        
</body>
</html>