
<div class="form-group">
    <label>SKU:</label>
    <input type="text" class="form-control" name="sku" placeholder="SKU" value="" required>
  </div>
  

  <div class="form-group">
    <label>Nombre:</label>
    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" required>
  </div>

   <div class="col-12 col-md-6 mb-3">
		<label for="mensaje">Nueva Descripcion :</label>
		<textarea name="descripcion" id="mensaje" class="form-control"></textarea>
   </div>

  <div class="form-group">
    <label>Imagen:</label>
    <div class="custom-file">
		  <input type="file" name="imagen" >
	  </div>
 </div>

  <div class="form-group">
    <label>Categoria :</label>
    <select name="categoriaPadre"  required>
    
    <option value="NINGUNA">NINGUNA</option>
    </select>
  <br><br>
  </div>
  
  <div class="form-group">
    <label>Stock :</label>
    <input type="number" class="form-control" name="stock" placeholder="stock"  value="" min="1" max="1000000" required>
  </div>

  <div class="form-group">
    <label>Precio :</label>
    <div class="input-group-prepend">
    <span class="input-group-text">$</span>
    </div>
    <input type="number" class="form-control" name="precio" placeholder="precio"  value="" min="1" max="1000000" required>
  </div>
