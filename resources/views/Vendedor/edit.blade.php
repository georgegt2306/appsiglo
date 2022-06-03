<form  class="needs-validation" id="edit_vendedor" autocomplete="off" novalidate>
   @csrf 
   {{ method_field('PUT') }}
    <div class="modal-header">
  
    <h4 class="modal-title">Editar</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">   
            <div class="col-md-12">

<input class="form-control" type="hidden" name="idunic" id="idunic" readonly="readonly"  value="{{$result_edit->id}}">

         
                <div class="form-group row">
                <label for="nombre" class="col-form-label col-sm-3">Nombre:</label>
                  <div class="col-sm-7">
                   <input  class="form-control" type="text" name="nombre" id="nombre" required > 
                   <div class="invalid-feedback" onkeypress="return soloLetras(event)">Ingrese Nombre.</div> 
                  </div>
                </div>
                <div class="form-group row">
                  <label for="apellido" class="col-form-label col-sm-3">Apellido:</label>
                    <div class="col-sm-7">
                     <input class="form-control" type="text" name="apellido" id="apellido" required> 
                     <div class="invalid-feedback" onkeypress="return soloLetras(event)">Ingrese Apellido.</div> 
                    </div>
                </div>
                <div class="form-group row">
                  <label for="contra_edit" class="col-form-label col-sm-3">Contraseña:</label>
                    <div class="col-sm-7">
                      <div class="input-group mb-3">
                      <input class="form-control" type="password" name="contra_edit" id="contra_edit" required minlength="6">    
                        <div class="input-group-append">
                          <div class="input-group-text"  onclick="mostrarPassword2();">
                            <span class="fa fa-eye-slash icon"></span>
                          </div>
                        </div> 
                      </div> 
                    </div>
                    <div class="invalid-feedback">Ingrese Contraseña, minimo 6 caracteres.</div> 
                </div>
                <div class="form-group row">
                  <label for="direccion" class="col-form-label col-sm-3">Dirección:</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="3" required></textarea>  
                     <div class="invalid-feedback">Ingrese Dirección.</div> 
                  </div>
                </div>


            </div>

    </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
</form>

<script type="text/javascript">


    remove_cursor_wait();
    $('#modale').modal();
    $('button[name=editar]').attr('disabled',false);




    var form2=document.getElementById('edit_vendedor');

    form2.addEventListener('submit', (event) => {
     event.preventDefault();
      if (!form2.checkValidity()) {
        event.stopPropagation();
      }else {
        const edit_sup = new FormData(form2); 
            $.ajax({
                url:"{{asset('')}}vendedor/{{$result_edit->id}}",
                type: 'POST',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: edit_sup,
                success:function(res){
                    if(res.sms){
                         consultar_tabla(); 
                         $('#modale').modal('hide');
                         toastr.success(res.mensaje);                    
                    }
                    else{               
                        Swal.fire({
                            closeOnClickOutside:false,
                            title: res.mensaje,
                            icon: "error",
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        });
                   }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (errorThrown=='Unauthorized') {
                      location.reload();
                    }
                }
            });   
        }
        form2.classList.add('was-validated');
    }, false);




    function mostrarPassword2(){
    var cambio = document.getElementById("contra_edit");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  } 
</script>