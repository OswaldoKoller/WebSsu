<div class="modal fade" id="modif_usuario" tabindex="-1" aria-labelledby="modif_usuario" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <label for=""></label>
      </div>
      <div class="modal-body">
            <form action="#" method="POST" enctype="multipart/form-data"> 
              <input type="hidden" name="id_persona" id="id_persona">
              <div class=" mb-3>
              <label for="nombre">NOMBRE: </label> 
              <input type="text" name="nombre" id="nombre" class="form-control" required>  
              </div>  
              <div class=" mb-3>
              <label for="apellido" class="form-label">APELLIDO : </label>
              <input type="text" name="apellido" id="apellido" class="form-control">
              </div>
              <div class=" mb-3>
              <label for="fecha_nac" class="form-label">FECHA DE NACIMIENTO : </label>
              <input type="date" name="fecha_nac" id="fecha_nac" class="form-control">
              </div>
              <div class=" mb-3> 
              <label for="telefono" class="form-label">TELEFONO : </label>
              <input type="text" name="telefono" id="telefono" class="form-control">
              </div>
              <div class=" mb-3>
              <label for="correo" class="form-label">CORREO : </label>
              <input type="email" name="correo" id="correo" class="form-control">
              </div>
              <div class=" mb-3>
              <label for="direccion" class="form-label">DIRECCION : </label>
              <input type="text" name="direccion" id="direccion" class="form-control">
              </div>
              <div class=" mb-3>
              <div class="form-group">
                            <label for="genero">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                              <option value="">Seleccione el estado</option>
                              <option value="1">Activo</option>
                              <option value="0">Baja</option>
                            </select>
              </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>      
                </div>

            </form>
      </div>
    </div>
  </div>
</div>