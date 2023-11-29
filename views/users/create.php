
<div class="content">
    <div class="container-fluid">
        <br>
        <div class="row justify-content-center"> 
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-body">
                        <a href="?c=users&m=index" class="btn btn-link">← Cancelar o volver</a>
                          <form action="views/users/insert_create.php" method="post">
                           
                            <div class="form-group mt-3">
                                <label for="">Nombres</label>
                                <input type="text" name="nombres"   class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Username</label>
                                <input type="text" name="username"   class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Password</label>
                                <input type="password" name="password"   class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Email</label>
                                <input type="text" name="email"   class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Direccion</label>
                                <input type="text" name="direccion"   class="form-control">
                                <div class="form-group mt-3">
                                <label for="">telefono</label>
                                <input type="text" name="telefono"   class="form-control">
                            </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mt-4">Guardar cambios</button>
                          

                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
