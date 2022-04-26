<form  class="needs-validation" id="edit_local" autocomplete="off" novalidate>
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
                    <label for="nombre_edit" class="col-form-label col-sm-3">Nombre:</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="nombre_edit" id="nombre_edit"  value="{{$result_edit->nombre}}" required maxlength="100">
                     <div class="invalid-feedback">Ingrese Nombre.</div> 
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



    $('#superv_edit').val({{$result_edit->id_supervisor}});
        $('#superv_edit').select2({
      theme: 'bootstrap4'
    })
    remove_cursor_wait();
    $('#modale').modal();
    $('button[name=editar]').attr('disabled',false);




    var form2=document.getElementById('edit_local');

    form2.addEventListener('submit', (event) => {
     event.preventDefault();
      if (!form2.checkValidity()) {
        event.stopPropagation();
      }else {
        const edit_sup = new FormData(form2); 
            $.ajax({
                url:"{{asset('')}}local/{{$result_edit->id}}",
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

</script>