<?php 
$filtro = $_GET["filtro"];

$cliente = new Cliente();
$clientes = $cliente -> buscar($filtro);

?>
<div class="container">
    <div class="row mb-3">
        <div class="col">        
            <?php 
            if (count($clientes) > 0) {
              echo "<table class='table table-striped table-hover'>";
              echo "<tr>";
              echo "<th>Estado</th>";
              echo "<th>Nombre</th>";
              echo "<th>Apellido</th>";
              echo "<th>Correo</th>";
              echo "</tr>";
          
              foreach ($clientes as $clienteActual) {
                  $estadoClase = $clienteActual->getEstado() != 0 ? 'btn-success' : 'btn-secondary';
                  $estadoIcono = $clienteActual->getEstado() != 0 ? 'fa-check-square' : 'fa-check-square-o';
                  $estadoNuevo = $clienteActual->getEstado() != 0 ? 0 : 1;          
                  echo "<tr>";
                  echo '<td>
                          <button class="btn ' . $estadoClase . ' btnActualizarCliente" idpersona="' . $clienteActual->getIdPersona() . '" estadoactuallead="' . $estadoNuevo . '"><i class="fa ' . $estadoIcono . '"></i></button>
                        </td>';
                  echo "<td>" . $clienteActual->getNombre() . "</td>";
                  echo "<td>" . $clienteActual->getApellido() . "</td>";
                  echo "<td>" . $clienteActual->getCorreo() . "</td>";
                  echo "</tr>";
              }
          
              echo "</table>";
          } else {
              echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
          }
          
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmacionModal" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3e383d; color: white;">
        <h5 class="modal-title" id="confirmacionModalLabel">Confirmación</h5>
      </div>
      <div class="modal-body text-center">
        <p>¿Desea Actualizar el estado de este cliente?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="ActualizarCliente">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let idPersonaSeleccionada;
    let estadoNuevoSeleccionado;
    let botonActual; 

    $(".btnActualizarCliente").click(function() {
      idPersonaSeleccionada = $(this).attr("idpersona");
      estadoNuevoSeleccionado = $(this).attr("estadoactuallead");
      botonActual = $(this); 

      console.log("ID Persona seleccionado: ", idPersonaSeleccionada);
      console.log("Nuevo estado seleccionado: ", estadoNuevoSeleccionado);

      $("#confirmacionModal").modal('show');
    });

    $("#ActualizarCliente").click(function() {
      if (idPersonaSeleccionada && estadoNuevoSeleccionado !== undefined) {
        console.log("Enviando ID Persona: ", idPersonaSeleccionada);
        console.log("Enviando Estado: ", estadoNuevoSeleccionado);

        let formData = new FormData();
        formData.append("idPersona", idPersonaSeleccionada);
        formData.append("estado", estadoNuevoSeleccionado);

        $.ajax({
          url: "indexAjax.php?pid=<?php echo base64_encode('presentacion/cliente/actualizarEstadoClienteAjax.php'); ?>",
          type: "POST",
          data: formData,
          processData: false, 
          contentType: false, 
          success: function(response) {
            console.log("Respuesta del servidor: ", response);
            $("#confirmacionModal").modal('hide');

            // Actualizar dinámicamente el botón
            if (estadoNuevoSeleccionado == 1) {
              botonActual.removeClass('btn-secondary').addClass('btn-success');
              botonActual.attr('estadoactuallead', 0); 
              botonActual.find('i').removeClass('fa-check-square-o').addClass('fa-check-square');
            } else {
              botonActual.removeClass('btn-success').addClass('btn-secondary');
              botonActual.attr('estadoactuallead', 1); 
              botonActual.find('i').removeClass('fa-check-square').addClass('fa-check-square-o');
            }
          },
          error: function(xhr, status, error) {
            console.error("Error al realizar la solicitud AJAX:", error);
            alert("Error al actualizar el estado. Por favor, inténtelo nuevamente.");
          }
        });
      } else {
        console.warn("ID Persona o Estado no definidos antes de enviar.");
      }
    });
  });
</script>
