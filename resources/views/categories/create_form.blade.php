<h1>Crea una nueva categoria</h1>
<form action="{{ route('category.store') }}" method="post">
    @csrf
    <label for="name">Nombre de la categoria:</label>
    <input type="text" name="name" id="name">
    <input type="submit" value="guardar">
</form>