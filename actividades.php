<?php
require_once ("template/cabecera.php");
require_once ("conexion.php");

//if (isset($_SESSION['id']))
//{
    $sql = "SELECT * FROM actividades";
    $resultado = $mysqli->query($sql);

    //ingresar nuevo
    if(isset($_POST['nuevo']))
    {
        $message = "";
        $messageERR = "";

        $nombre = $_POST['nombre'];
        $status = $_POST['status'];

        if(empty($_POST['nombre']) && empty($_POST['status']))
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlRegistrar = "INSERT INTO actividades (nombre, status) VALUES ('$nombre', '$status')";
            $result_registrar = $mysqli->query($sqlRegistrar);

            $message = "La actividad fue registrada correctamente.";
            
        }
    }

    // modificar registro
    if(isset($_POST['modificar']))
    {
        $message = "";
        $messageERR = "";

        $id_m = $_POST['id'];
        $nombre_m = $_POST['nombre'];
        $status_m = $_POST['status'];

        if(empty($_POST['nombre']) && empty($_POST['status']))
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlModificar = "UPDATE actividades SET nombre='$nombre_m', status='$status_m' WHERE id='$id_m'";
            $result_modificar = $mysqli->query($sqlModificar);

            $message = "La actividad fue actualizada correctamente.";
        }
    }
//}
?>
<div class="container">
    <div class="card bg-secondary mb-3" style="width: 100%;">
    <div class="card-header">Actividades y Eventos</div>
    <div class="card-body">
        <h4 class="card-title">Control y gestión de las actividades de la Junta Comunal de Don Bosco</h4>
        </br>
        <?php 
            if(!empty($message))
            {
        ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= $message ?></strong>
                </div>
        <?php
            }
            if(!empty($messageERR))
            {
        ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= $messageERR ?></strong>
                </div>
        <?php
            }
        ?>
        <button type="button" id="showform" class="btn btn-success col-md-2" onclick="showNuevo()">Nueva actividad</button>
        <button type="button" id="hideform" class="fa fa-eye-slash btn btn-outline-dark col-md-1" onclick="ocultarForm()" style="display: none;"></button>
        <form method="POST"action="actividades.php" id="form" style="display: none; width: 500px; padding: 30px; margin: auto; background:lightblue; margin-top: 20px; margin-bottom: 20px; color: black; border-radius:4px;">
            <input type="hidden" id="id" name="id" />
            <label for="">Nombre de la actividad o evento</label><span class="text-danger">*</span>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="" required>
            <label for="" style="margin-top: 10px;">Estado</label><span class="text-danger">*</span>
            <select class="form-select" id="status" name="status" style="width: 250px;" required>
                <option>Activo</option>
                <option>Cancelado</option>
            </select>
            <button type="submit" id="nuevo" name="nuevo" class="btn btn-success" style="margin-top: 15px">Guardar</button>
            <button onclick="able()" type="submit" id="modificar" name="modificar" class="btn btn-info" style="margin-top: 15px">Guardar cambios</button>
        </form>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-table me-1"></i>
                Lista de Actividades y Eventos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                        while($row = $resultado->fetch_assoc())
                        {
                            $id_act = $row['id'];
                            $nom_act = $row['nombre'];
                            $status_act = $row['status'];
                    ?>
                        <tr>
                            <td id="i<?=$row['id']?>"><?php echo $id_act; ?></td>
                            <td id="n<?=$row['id']?>"><?php echo $nom_act; ?></td>
                            <td id="s<?=$row['id']?>"><?php echo $status_act; ?></td>
                            <td><a name="editar" href="#" onclick="showEditar('<?php echo $id_act; ?>')"><span class="fa fa-pencil-square-o"></span></a></td>
                            <td><a href="#" data-href="borrarActividad.php?id=<?php echo $id_act; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Actividad</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"><span aria-hidden="true"></span></button>
                </div>
                <!--<form method="POST" action="borrarUsuario.php">-->
                    <div class="modal-body">
                        <p>¿Desea eliminar este registro?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-primary btn-ok">Eliminar</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                <!--</form>-->
                </div>
            </div>
        </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>                        
    <script>
        
        const form = document.getElementById('form');

        function showNuevo()
        {
            document.getElementById('form').style.display = '';
            document.getElementById('nuevo').style.display = '';
            document.getElementById('modificar').style.display = 'none';
            document.getElementById('showform').style.display = 'none';
            document.getElementById('hideform').style.display = '';
            document.getElementById('nombre').disabled = false;
            form.reset();
        }

        function showEditar(id)
        {   
            console.log(id);
            document.getElementById('form').style.display = '';
            document.getElementById('nuevo').style.display = 'none';
            document.getElementById('modificar').style.display = '';
            document.getElementById('showform').style.display = 'none';
            document.getElementById('hideform').style.display = '';
            document.getElementById('nombre').disabled = true;
            idA = document.getElementById('i'+id).innerHTML;
            nombre = document.getElementById('n'+id).innerHTML;
            status = document.getElementById('s'+id).innerHTML;
            $("#id").val(idA);
            $("#nombre").val(nombre);
            $("#status").val(status);
        }

        function ocultarForm()
        {
            document.getElementById('form').style.display = 'none';
            document.getElementById('showform').style.display = '';
            document.getElementById('hideform').style.display = 'none';
        }

        function able()
        {
            document.getElementById('nombre').disabled = false;
        }
    </script>
<?php
require_once ("template/pie.php");
?>