function init() {
    $("#form_sucursal").on("submit", (e) => {
      GuardarEditar(e);
    });
  }
  
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    var html = "";
    $.get( "../../controllers/sucursal2.controller.php?op=todos",
      (LisSucursales) => {
        LisSucursales = JSON.parse(LisSucursales);
        $.each(LisSucursales, (index, sucursales) => {
          html += `<tr>
              <td>${index + 1}</td>
              <td>${sucursales.Nombre}</td>
              <td>${sucursales.Direccion}</td>
              <td>${sucursales.Telefono}</td>
              <td>${sucursales.Correo}</td>
              <td>${sucursales.Parroquia}</td>
              <td>${sucursales.Canton}</td>
              <td>${sucursales.Provincia}</td>

  <td>
  <button class='btn btn-primary' click='uno(${
    sucursales.SucursalId
          })'>Editar</button>
  <button class='btn btn-warning' click='eliminar(${
    sucursales.SucursalId
          })'>Editar</button>
              `;
        });
        $("#ListaSucursales").html(html);
      }
    );
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioSucursal = new FormData($("#form_sucursal")[0]);
    var accion = "../../controllers/sucursal2.controller.php?op=insertar";
  
    for (var pair of DatosFormularioSucursal.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  
    /**
     * if(SucursalId >0){editar   accion='ruta para editar'}
     * else
     * { accion = ruta para insertar}
     */
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioSucursal,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          alert("Se guardo con éxito");
          CargaLista();
          LimpiarCajas();
        } else {
          alert("no  vale tu pendejada");
        }
      },
    });
  };
  
  var uno = () => {};
  
  var sucursales = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/sucursal.controllers.php?op=todos",
        async (ListaSucursales) => {
          ListaSucursales = JSON.parse(ListaSucursales);
          $.each(ListaSucursales, (index, sucursal) => {
            html += `<option value="${sucursal.SucursalId}">${sucursal.Nombre}</option>`;
          });
          await $("#SucursalId").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
  };
  
  var roles = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/rol.controllers.php?op=todos",
        async (ListaRoles) => {
          ListaRoles = JSON.parse(ListaRoles);
          $.each(ListaRoles, (index, rol) => {
            html += `<option value="${rol.idRoles}">${rol.Rol}</option>`;
          });
          await $("#RolId").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
  };
  
  var eliminar = () => {};
  
  var LimpiarCajas = () => {
    (document.getElementById("Nombres").value = ""),
      (document.getElementById("Apellidos").value = ""),
      (document.getElementById("Correo").value = ""),
      (document.getElementById("contrasenia").value = ""),
      $("#ModalUsuarios").modal("hide");
  };
  init();