<h1>Crea un nuevo producto</h1>
<form action="{{ route('product.store') }}" method="post">
    @csrf
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" placeholder="Producto interesante">
    <br><br>
    <label for="description">Descripción:</label>
    <input type="text" name="description" id="description" placeholder="Descripcion descriptiva">
    <br><br>
    <label for="stock">Stock:</label>
    <input type="number" name="stock" id="stock" placeholder="20">
    <br><br>
    <label for="price">Precio:</label>
    <input type="number"  name="price" id="price" step="0.01" placeholder="1.23">
    <br><br>
    <label for="featured">Producto destacado?</label>
    <input type="checkbox" name="featured" id="featured">
    <br><br>
    <label for="code">Codigo del producto:</label>
    <input type="text" name="code" id="code" placeholder="ca123-pr">
    <br><br>
    <input type="submit" value="guardar">
</form>