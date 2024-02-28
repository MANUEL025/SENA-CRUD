<div class="content">
    <div class="container-fluid">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="?c=products&m=index" class="btn btn-link">← Cancelar o volver</a>

                        <form action="views/products/insert_create.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mt-3">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Descripcion</label>
                                <input type="text" name="descripcion" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Precio</label>
                                <input type="text" name="precio" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Cantidad</label>
                                <input type="text" name="cantidad" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="imagen">Imagen</label>
                                <input type="file" id="imagen" name="imagen" class="form-control">
                            </div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>