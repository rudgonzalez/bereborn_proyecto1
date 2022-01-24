<?php
require_once ("template/cabecera.php");
require_once ("conexion.php");

//if (isset($_SESSION['id']))
//{
    $sql = "SELECT * FROM usuario";
    $resultado = $mysqli->query($sql);

    //ingresar nuevo
    if(isset($_POST['guardar']))
    {
        $message = "";
        $messageERR = "";

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $tipo_usuario = $_POST['tipo_usuario'];

        $pass_c = sha1($password);

        if(empty($_POST['usuario']) && empty($_POST['password']) && empty($_POST['nombre']) && empty($_POST['tipo_usuario']) )
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlRepetido = "SELECT * FROM usuario WHERE usuario = '$usuario'";
            $result_repetido = $mysqli->query($sqlRepetido);

            if($result_repetido->num_rows >0)
            {
                $messageERR = "El usuario ya existen.";
            }
            else
            {
                $sqlRegistrar = "INSERT INTO usuario (usuario, password, nombre, tipo_usuario) VALUES ('$usuario', '$pass_c', '$nombre', '$tipo_usuario')";
                $result_registrar = $mysqli->query($sqlRegistrar);

                $message = "EL usuario fue registrado exitosamente.";
            }
        }
    }
    // modificar registro
    if(isset($_POST['actualizar']))
    {
        $message = "";
        $messageERR = "";

        $idmodifica = $_POST['id'];
        $usuario_m = $_POST['usuario'];
        $password_m = $_POST['password'];
        $nombre_m = $_POST['nombre'];
        $tipo_usuario_m = $_POST['tipo_usuario'];

        $pass_c_m = sha1($password_m);

        if(empty($_POST['usuario']) && empty($_POST['password']) && empty($_POST['nombre']) && empty($_POST['tipo_usuario']) )
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlModificar = "UPDATE usuario SET usuario='$usuario_m', password='$pass_c_m', nombre='$nombre_m', tipo_usuario='$tipo_usuario_m' WHERE id='$idmodifica'";
            $result_modificar = $mysqli->query($sqlModificar);

            $message = "EL usuario fue actualizado exitosamente.";
        }
    }

?>
    <div class="card bg-secondary mb-3">
        <div class="card-header">Registro de Usuarios</div>
        <br/>
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
        <div class="form-row mb-3" style="margin: 15px 0px 15px 0px;">
            <button type="button" id="showform" class="btn btn-success col-md-2" onclick="showNuevo()">Nuevo</button>
            <button type="button" id="hideform" class="fa fa-eye-slash btn btn-outline-dark col-md-1" onclick="ocultarForm()" style="display: none;"></button>
        </div>
        <br/>
        <form style="margin: 0px 15px 20px 15px; display: none;" id="form" action="registroUsuarios.php" method="POST">
            <div class="form-row mb-3" style="margin: 0px 0px 15px 0px;">
                <!-- id oculto -->
                <input type="hidden" id="id" name="id" />
                <div class="form-group col-md-3" style="float: left; margin: 0px 10px 0px 0px;">
                    <label class="form-label mt-4">Usuario</label><span class="text-danger">*</span>
                    <input type="text" id="user" class="form-control" name="usuario" required>
                </div>
                <div class="form-group col-md-3" style="float: left; margin: 0px 10px 0px 0px;">
                    <label class="form-label mt-4">Contraseña</label><span class="text-danger">*</span>
                    <input type="text" id="con" class="form-control" name="password" required>
                </div>
                <div class="form-group col-md-3" style="float: left; margin: 0px 10px 0px 0px;">
                    <label class="form-label mt-4">Nombre</label><span class="text-danger">*</span>
                    <input type="text" id="nom" class="form-control" name="nombre" required>
                </div>
                <div class="form-group col-md-2" style="float: left; margin: 0px 10px 0px 0px;">
                    <label for="exampleSelect1" class="form-label mt-4">Tipo de usuario</label><span class="text-danger">*</span>
                        <select class="form-select" id="exampleSelect1" name="tipo_usuario" required>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    <small id="emailHelp" class="form-text text-muted">Administrador "1" / Usuario estandar "2"</small>
                </div>
            </div>
            <div class="form-row mb-3" style="margin: 15px 20px 15px 0px;">
                <div class="form-group col-md-2" style="float: left; margin: 0px 10px 0px 0px;" id="nuevo">    
                    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
                </div>
                <div class="form-group col-md-3" style="float: left; margin: 0px 10px 0px 0px;" id="modificar">    
                    <button type="submit" name="actualizar" class="btn btn-info">Guardar cambios</button>
                </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-table me-1"></i>
                Lista de usuarios
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Nombre</th>
                            <th>Tipo de Usuario</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Nombre</th>
                            <th>Tipo de Usuario</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                            while($row = $resultado->fetch_assoc())
                            {
                                $id_usuario = $row['id'];
                                $user = $row['usuario'];
                                $contrasenia = $row['password'];
                                $name = $row['nombre'];
                                $tusuario = $row['tipo_usuario'];
                        ?>
                        <tr>
                            <td id="i<?=$row['id']?>"><?php echo $id_usuario; ?></td>
                            <td id="u<?=$row['id']?>"><?php echo $user; ?></td>
                            <td id="p<?=$row['id']?>"><?php echo $contrasenia; ?></td>
                            <td id="n<?=$row['id']?>"><?php echo $name; ?></td>
                            <td id="t<?=$row['id']?>"><?php if($tusuario == 1){echo ("Administrador");}else if($tusuario == 2){echo ("Usuario estandar");}?></td>
                            <td><a name="editar" href="#" onclick="showEditar('<?php echo $id_usuario; ?>')"><span class="fa fa-pencil-square-o"></span></a></td>
                            <td><a href="#" data-href="borrarUsuario.php?id=<?php echo $id_usuario;?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
        <div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Usuario</h5>
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
            idP = document.getElementById('i'+id).innerHTML;
            usuario = document.getElementById('u'+id).innerHTML;
            password = document.getElementById('p'+id).innerHTML;
            nombre = document.getElementById('n'+id).innerHTML;
            tusuario = document.getElementById('t'+id).innerHTML;
            $("#id").val(idP);
            $("#user").val(usuario);
            $("#con").val(password);
            $("#nom").val(nombre);
            if(tusuario=='Administrador')
            {
                $("#exampleSelect1").val('1');
            }
            else
            {
                $("#exampleSelect1").val('2');
            }
        }

        function ocultarForm()
        {
            document.getElementById('form').style.display = 'none';
            document.getElementById('showform').style.display = '';
            document.getElementById('hideform').style.display = 'none';
        }
    </script>
<?php
//}
require_once ("template/pie.php");
?>