$(document).ready(function () {
    cargarDatos();
  
    $("#btn-insertar").on("click", function () {
      $("#usuarioModalLabel").text("Añadir");
      $("#form-usuario")[0].reset();
      $("#form-usuario").attr("data-modo", "crear");
      $('input[name="cedula"]').prop("readonly", false);
    });
  
    $(document).on("click", ".edit-btn", function () {
      const row = $(this).closest("tr");
      $("#usuarioModalLabel").text("Editar Usuario");
      $("#form-usuario")[0].reset();
      $('input[name="cedula"]').val(row.data("cedula")).prop("readonly", true);
      $('input[name="nombre"]').val(row.find("td:eq(1)").text());
      $('input[name="apellido"]').val(row.find("td:eq(2)").text());
      $('input[name="direccion"]').val(row.find("td:eq(3)").text());
      $('input[name="telefono"]').val(row.find("td:eq(4)").text());
      $("#form-usuario").attr("data-modo", "editar");
    });
    
    $("#form-usuario").on("submit", function (e) {
      e.preventDefault();
  
      const modo = $(this).attr("data-modo");
      const formData = {
        cedula: $('input[name="cedula"]').val(),
        nombre: $('input[name="nombre"]').val(),
        apellido: $('input[name="apellido"]').val(),
        direccion: $('input[name="direccion"]').val(),
        telefono: $('input[name="telefono"]').val(),
      };
  
      const cerrarModal = () => {
        const modalElement = document.getElementById("usuarioModal");
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
          modal.hide();
        }
      };
  
      if (modo === "editar") {
        $.ajax({
          url: "../Controllers/apiRest.php",
          type: "PUT",
          contentType: "application/json",
          data: JSON.stringify(formData),
          success: function () {
            console.log("Usuario actualizado");
            $("#form-usuario")[0].reset();
            cargarDatos();
            cerrarModal();
          },
          error: function () {
            console.error("Error al actualizar usuario");
          },
        });
      } else {
        $.ajax({
          url: "../Controllers/apiRest.php",
          type: "POST",
          data: formData,
          success: function () {
            console.log("Usuario agregado");
            $("#form-usuario")[0].reset();
            cargarDatos();
            cerrarModal();
          },
          error: function () {
            console.error("Error al agregar usuario");
          },
        });
      }
    });
  });
  function cargarDatos() {
    $.ajax({
      url: "../Controllers/apiRest.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        const tbody = $("#tabla-bootstrap tbody");
        tbody.empty();
  
        data.forEach(function (item) {
          const row = `
                <tr data-cedula="${item.cedula}">
                  <td>${item.cedula}</td>
                  <td>${item.nombre}</td>
                  <td>${item.apellido}</td>
                  <td>${item.direccion}</td>
                  <td>${item.telefono}</td>
                  <td>
                    <button class="btn btn-sm btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#usuarioModal"><i class="bi bi-pen-fill"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser('${item.cedula}')"><i class="bi bi-trash-fill"></i></button>
                  </td>
                </tr>
              `;
          tbody.append(row);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error al cargar datos:", error);
      },
    });
  }
  function deleteUser(cedula) {
    if (
      !confirm(
        "¿Seguro que quieres eliminar al usuario con cédula?"
      )
    )
      return;
    $.ajax({
      url: "../Controllers/apiRest.php?cedula=" + encodeURIComponent(cedula),
      type: "DELETE",
      success: function () {
        cargarDatos();
      },
      error: function () {
        console.error("Error al eliminar usuario");
      },
    });
  }