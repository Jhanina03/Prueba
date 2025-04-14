    function cargarDatos(){
        $.ajax({
            url:"../Controllers/apiRest.php",
            type:"GET",
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#dg').datagrid('loadData', data);
                $('#dg').datagrid('reload');

            },
            error: function(xhr, status, error){
                alert("Error al cargar estudiante");
            }
            
        })

    }

    $(document).ready(
        function(){
            cargarDatos();
        $("#fm").submit(function(event){
            event.preventDefault(); 
            var formData = $(this).serialize();
            var formulario = this;
            $.ajax({
            url:"../Controllers/apiRest.php",
            type:"POST",
            data: formData,
            success: function(){
                alert("Estudiante guardado");
                formulario.reset();
                $('#dlg').dialog("close");
                window.location.reload();

            }, 
            error: function(jqHRX, textStatus, errorTrown){
                alert("Error al guardar estudiante", textStatus,errorTrown);
            }
                
            })


        })
    });

    function updateUser() {
        const formData = {
          cedula: $('input[name="cedula"]').val(),
          nombre: $('input[name="nombre"]').val(),
          apellido: $('input[name="apellido"]').val(),
          direccion: $('input[name="direccion"]').val(),
          telefono: $('input[name="telefono"]').val(),
        };
      
        $.ajax({
          url: "../Controllers/apiRest.php",
          method: "PUT",
          contentType: "application/json",
          data: JSON.stringify(formData),
          success: function () {
            $("#fm")[0].reset();
            $("#dlg").dialog("close");
            cargarDatos();
          },
          error: function () {
            $.messager.alert("Error", "Hubo un problema al actualizar el usuario.");
          },
        });
      }
    
    function eliminarDatos(cedula) {
        $.ajax({
            url: "../Controllers/apiRest.php?cedula=" + cedula, 
            type: "DELETE",
            dataType :"json",
            success: function(response) {
                if(response.message){
                    cargarDatos();
                }else{
                    alert("Error al eliminar" + (response.error|| "Desconocido"));
                }
            }
        });
    }