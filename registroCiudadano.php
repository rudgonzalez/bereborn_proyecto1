<?php
require_once ("template/cabecera.php");
require_once ("conexion.php");

//if (isset($_SESSION['id']))
//{
     //ingresar nuevo
    if(isset($_POST['nuevo']))
    {
         $message = "";
         $messageERR = "";
 
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apaterno = $_POST['apaterno'];
        $amaterno = $_POST['amaterno'];
        $nacimiento = $_POST['nacimiento'];
        $sexo = $_POST['sexo'];
        $email = $_POST['email'];
        $tel_resid = $_POST['tel_resid'];
        $tel_ofi = $_POST['tel_ofi'];
        $cel1 = $_POST['cel1'];
        $cel2 = $_POST['cel2'];
        $sector = $_POST['sector'];
        $direccion = $_POST['direccion'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];

        $valid = $_POST['isValid'];
        $string = $_POST['inputString'];
        $complete = $_POST['isComplete'];
        $separated = $_POST['separated'];
 
        if(empty($_POST['cedula']) && empty($_POST['nombre']) && empty($_POST['apaterno']) && empty($_POST['amaterno']) && empty($_POST['nacimiento']) && empty($_POST['sexo']) && empty($_POST['email']) && empty($_POST['cel1']) && empty($_POST['sector']) && empty($_POST['direccion']))
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            if($valid != "true" && $complete != "true" && $separated == "null")
            {
                $messageERR = "El formato de la cedula no es el correcto.";
            }
            else
            {
                $sqlRepetido = "SELECT * FROM ciudadanos WHERE cedula = '$cedula'";
                $result_repetido = $mysqli->query($sqlRepetido);

                if($result_repetido->num_rows >0)
                {
                    $messageERR = "El ciudadano ya esta registrado.";
                }
                else
                {
                    $sqlRegistrar = "INSERT INTO ciudadanos (cedula, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, correo, telefono_resid, telefono_ofi, celular1, celular2, sector, direccion, facebook, instagram) 
                    VALUES ('$cedula', '$nombre', '$apaterno', '$amaterno', '$nacimiento', '$sexo', '$email', '$tel_resid', '$tel_ofi', '$cel1', '$cel2', '$sector', '$direccion', '$facebook', '$instagram')";
                    $result_registrar = $mysqli->query($sqlRegistrar);

                    $message = "El ciudadano fue registrado correctamente.";
                }
            }         
        }
    }

    // Buscar ciudadano
    if(isset($_POST['buscar']))
    {
        //$where ="";

        // En caso que necesite cargar la tabla ciudadano al inicio de la pagina y luego necesite cargarla con alguna condicion.
        //if(!empty($_POST))
        //{
            //$valor = $_POST['buscar_cedula'];

            //if(!empty($valor))
            //{
            // $where = "WHERE cedula = '$cedula'";
        // }
        //}
                
        $cedula_b = $_POST['buscar_cedula'];
        
        if(empty($_POST['buscar_cedula']))
        {
            $messageERR = "Por favor ingrese un no. de cedula";
        }
        else
        {
            $sqlBuscar = "SELECT * FROM ciudadanos WHERE cedula = '$cedula_b'";
            $result_buscar = $mysqli->query($sqlBuscar);
        
            if ($result_buscar->num_rows == 0)
            {
                $messageERR ="El no. de cedula que esta buscando no existe.";
            }
            else
            {
                while($row = $result_buscar->fetch_assoc())
                {
                    $id_b = $row['id'];
                    $cedula_b = $row['cedula'];
                    $nombre_b = $row['nombre'];
                    $app_b = $row['apellido_paterno'];
                    $apm_b = $row['apellido_materno'];
                    $fnac_b = $row['fecha_nacimiento'];
                    $sexo_b = $row['sexo'];
                    $correo_b = $row['correo'];
                    $tresid_b = $row['telefono_resid'];
                    $tofi_b = $row['telefono_ofi'];
                    $cel1_b = $row['celular1'];
                    $cel2_b = $row['celular2'];
                    $sector_b = $row['sector'];
                    $dir_b = $row['direccion'];
                    $fb_b = $row['facebook'];
                    $inst_b = $row['instagram'];
                }
            }   
        }       
    }
    

    // modificar registro
    if(isset($_POST['modificar']))
    {
        $message = "";
        $messageERR = "";

        $id_m = $_POST['id'];
        $cedula_m = $_POST['cedula'];
        $nombre_m = $_POST['nombre'];
        $apaterno_m = $_POST['apaterno'];
        $amaterno_m = $_POST['amaterno'];
        $nacimiento_m = $_POST['nacimiento'];
        $sexo_m = $_POST['sexo'];
        $email_m = $_POST['email'];
        $tel_resid_m = $_POST['tel_resid'];
        $tel_ofi_m = $_POST['tel_ofi'];
        $cel1_m = $_POST['cel1'];
        $cel2_m = $_POST['cel2'];
        $sector_m = $_POST['sector'];
        $direccion_m = $_POST['direccion'];
        $facebook_m = $_POST['facebook'];
        $instagram_m = $_POST['instagram'];

        if(empty($_POST['cedula']) && empty($_POST['nombre']) && empty($_POST['apaterno']) && empty($_POST['amaterno']) && empty($_POST['nacimiento']) && empty($_POST['sexo']) && empty($_POST['email']) && empty($_POST['cel1']) && empty($_POST['sector']) && empty($_POST['direccion']))
        {
            $messageERR = "Algunos de los campos obligatorios esta vacio.";
        }
        else 
        {
            $sqlModificar = "UPDATE ciudadanos SET cedula='$cedula_m', nombre='$nombre_m', apellido_paterno='$apaterno_m', apellido_materno='$amaterno_m', fecha_nacimiento='$nacimiento_m', sexo='$sexo_m', correo='$email_m', telefono_resid='$tel_resid_m', telefono_ofi='$tel_ofi_m', celular1='$cel1_m', celular2='$cel2_m', sector='$sector_m', direccion='$direccion_m', facebook='$facebook_m', instagram='$instagram_m' WHERE id='$id_m'";
            $result_modificar = $mysqli->query($sqlModificar);

            $message = "EL registro fue actualizado exitosamente.";
        }
    }
?>
    <div class="card bg-secondary mb-3">
        <div class="card-header">Registro de Ciudadanos</div>
        <div class="card-body">
            <h4 class="card-title">Datos personales de ciudadanos residentes en el corregimiento de Don Bosco</h4>
        </div>
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
        <form id="form_b" method="POST" action="registroCiudadano.php">
            <div class="input-group mb-3 container-fluid" style="width: 400px;">
                <input id="" type="text" name="buscar_cedula" class="form-control" placeholder="Ingresar No. Cédula" aria-label="Ingresar No. cédula" aria-describedby="button-addon2" required>
                <button name="buscar" type="submit" class="btn btn-primary" id="buscar">Buscar</button>
            </div>
        </form>
        <div class="form-row mb-3" style="margin: 15px 0px 15px 0px;">
            <button type="button" id="showform" class="btn btn-success col-md-2" onclick="nuevo()" <?php if(isset($_POST['buscar'])){ ?> Style="display: none;" <?php } ?>>Nuevo</button>
            <button onclick="editar()" type="button" id="editar" class="btn btn-info col-md-2" <?php if(!isset($_POST['buscar'])){ ?> style="display: none;" <?php } ?>>Editar</button>
            <?php 
            if(isset($_SESSION['id']) && $tipo_usuario == 1)
            {
            ?>
            <a type="button" href="#" data-href="borrarCiudadano.php?id=<?php echo $id_b; ?>" data-toggle="modal" data-target="#confirm-delete" id ="eliminar"class="btn btn-danger col-md-2" <?php if(!isset($_POST['buscar'])){ ?> style="display: none;" <?php } ?>>Eliminar</a>
            <?php
            }
            ?>
            <button type="button" id="hideform" class="fa fa-eye-slash btn btn-outline-dark col-md-1" onclick="ocultarForm()" style="<?php if(!isset($_POST['buscar'])){ ?> display: none; <?php } ?> float: right; height: 55px;"></button>
        </div>
        <br/>
        <form id="form" action="registroCiudadano.php" method="POST" style="width: 1000px; margin: auto; background:powderblue; margin-bottom: 30px; padding: 30px; border-radius: 4px; <?php if(isset($_POST['buscar'])){ ?> display: flex; <?php }else{?> display: none; <?php } ?> flex-wrap:wrap;">
            <input type="hidden" id="id" name="id" <?php if(isset($_POST['buscar'])){?> value="<?php echo $id_b; ?>" <?php } ?>/>
            <div style="width: 190px; float: left; padding: 5px;">
                <label class="form-label mt-4">No. Cédula</label><span class="text-danger">*</span>
                <input id="cedula" name="cedula" onkeyup="validate(this.value)" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $cedula_b; ?>" <?php } ?> required>
                <!-- validando cedula-->
                <input id="isValid"  type="hidden" name="isValid">
                <input id="inputString" type="hidden" name="inputString">
                <input id="isComplete" type="hidden" name="isComplete">
                <input id="separated" type="hidden" name="separated">
            </div>
            <div style="width: 270px; float: left; padding: 5px;">
                <label class="form-label mt-4">Nombre</label><span class="text-danger">*</span>
                <input id="nombre" name="nombre" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $nombre_b; ?>" <?php } ?> required>
            </div>
            <div style="width: 240px; float: left; padding: 5px;">
                <label class="form-label mt-4">Apellido paterno</label><span class="text-danger">*</span>
                <input id="apaterno" name="apaterno" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $app_b; ?>" <?php } ?> required>
            </div>
            <div style="width: 240px; float: left; padding: 5px;">
                <label class="form-label mt-4">Apellido materno</label><span class="text-danger">*</span>
                <input id="amaterno" name="amaterno" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $apm_b; ?>" <?php } ?> required>
            </div>
            <div style="width: 210px; float: left; padding: 5px;">
                <label class="form-label mt-4">Fecha de nacimiento</label><span class="text-danger">*</span>
                <input id="nacimiento" name="nacimiento" type="date" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $fnac_b; ?>" <?php } ?> required>
            </div>
            <div style="width: 190px; float: left; padding: 5px;">
                <label for="exampleSelect1" class="form-label mt-4">Sexo</label><span class="text-danger">*</span>
                <select name="sexo" class="form-select" id="sexo" <?php if(isset($_POST['buscar'])){?> value="<?php echo $sexo_b; ?>" <?php } ?> required>
                    <option>Masculino</option>
                    <option>Femenino</option>
                </select>
            </div>
            <div style="width: 350px; float: left; padding: 5px;">
                <label class="form-label mt-4">Correo electrónico</label><span class="text-danger">*</span>
                <input id="email" name="email" type="email" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $correo_b; ?>" <?php } ?>>
            </div>
            <div style="width: 190px; float: left; padding: 5px;">
                <label class="form-label mt-4">Teléfono residencial</label>
                <input id="tel_resid" name="tel_resid" type="tel" class="form-control" pattern="[0-9]{3}-[0-9]{4}" <?php if(isset($_POST['buscar'])){?> value="<?php echo $tresid_b; ?>" <?php } ?>>
                <small id="" class="form-text text-muted">Formato: xxx-xxxx</small>
            </div>
            <div style="width: 190px; float: left; padding: 5px;">
                <label class="form-label mt-4">Teléfono oficina</label>
                <input id="tel_ofi" name="tel_ofi" type="tel" class="form-control" pattern="[0-9]{3}-[0-9]{4}" <?php if(isset($_POST['buscar'])){?> value="<?php echo $tofi_b; ?>" <?php } ?>>
                <small id="" class="form-text text-muted">Formato: xxx-xxxx</small>
            </div>
            <div style="width: 190px; float: left; padding: 5px;">
                <label class="form-label mt-4">Teléfono celular 1</label><span class="text-danger">*</span>
                <input id="cel1" name="cel1" type="tel" class="form-control" pattern="[0-9]{4}-[0-9]{4}" required <?php if(isset($_POST['buscar'])){?> value="<?php echo $cel1_b; ?>" <?php } ?>>
                <small id="" class="form-text text-muted">Formato: xxxx-xxxx</small>
            </div>
            <div style="width: 190px; float: left; padding: 5px;">
                <label class="form-label mt-4">Teléfono celular 2</label>
                <input id="cel2" name="cel2" type="tel" class="form-control" pattern="[0-9]{4}-[0-9]{4}" <?php if(isset($_POST['buscar'])){?> value="<?php echo $cel2_b; ?>" <?php } ?>>
                <small id="" class="form-text text-muted">Formato: xxxx-xxxx</small>
            </div>
            <div style="width: 370px; float: left; padding: 5px;">
                <label for="exampleSelect1" class="form-label mt-4">Comunidad o barriada</label><span class="text-danger">*</span>
                <select name="sector" class="form-select" id="sector" <?php if(isset($_POST['buscar'])){?> value="<?php echo $sector_b; ?>" <?php } ?> required>
                    <option>Don Bosco</option>
                    <option>Costa Sur</option>
                    <option>Versalles</option>
                    <option>Las Acacias</option>
                    <option>Las Rivieras</option>
                    <option>Los Caobos</option>
                </select>
            </div>
            <div style="width: 500px; float: left; padding: 5px;">
                <label class="form-label mt-5">Dirección</label><span class="text-danger">*</span>
                <input id="direccion" name="direccion" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $dir_b; ?>" <?php } ?> required>
                <small id="" class="form-text text-muted">Calle y no. casa / edificio y no. apto</small>
            </div>
            <div style="width: 220px; float: left; padding: 5px; margin-top: 55px;">
                <a href="#" class="fa fa-facebook-official"></a>
                <input id="facebook" name="facebook" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $fb_b; ?>" <?php } ?>>
            </div>
            <div style="width: 220px; float: left; padding: 5px; margin-top: 55px;">
                <a href="#" class="fa fa-instagram"></a>
                <input id="instagram" name="instagram" type="text" class="form-control" <?php if(isset($_POST['buscar'])){?> value="<?php echo $inst_b; ?>" <?php } ?>>
            </div>
            <!-- Tabla de actividades-->
            <div id="tabla" class="card mb-4" style="margin:auto; margin-top: 20px; margin-bottom: 20px;">
                <div class="card-header">
                    <i class="fa fa-table me-1"></i>
                    Lista de Actividades y Eventos
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Actividad o Evento</th>
                                <th>Comentario</th>
                                <th>Registrado por</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_POST['buscar']))
                                {
                                    $sqlact = "SELECT actividades.nombre as nombre_act, usuario.nombre as nombre_user, 
                                    registro_actividad.fecha as fecha_reg, registro_actividad.comentario as comentario from 
                                    registro_actividad INNER JOIN actividades ON 
                                    registro_actividad.idActividad=actividades.id INNER JOIN usuario ON 
                                    registro_actividad.id_usuario=usuario.id WHERE 
                                    registro_actividad.idCiudadano='$id_b'";
                                    $result_bus_act = $mysqli->query($sqlact);
                                    
                                    while($row_a = $result_bus_act->fetch_assoc())
                                    {
                            ?>
                            <tr>
                                <td><?php echo $row_a['nombre_act']; ?></td>
                                <td><?php echo $row_a['comentario']; ?></td>
                                <td><?php echo $row_a['nombre_user']; ?></td>
                                <td><?php echo $row_a['fecha_reg']; ?></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="padding: 5px; margin-top: 20px;">
                <button id="nuevo" name="nuevo" type="submit" class="btn btn-success" <?php if(isset($_POST['buscar'])){ ?> style="display: none;" <?php } ?>>Guardar</button>
                <button id="modificar" name="modificar" type="submit" class="btn btn-info" <?php if(isset($_POST['buscar'])){ ?> style="display: none;" <?php } ?>>Guardar cambios</button>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Eliminar Registro </h5>
                <button type="button" class="btn-close" data-dismiss="modal"><span aria-hidden="true"></span></button>
            </div>
                <div class="modal-body">
                    <p>¿Desea eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-primary btn-ok">Eliminar</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
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

        function nuevo()
        {
            
            document.getElementById('form').style.display = 'flex';
            document.getElementById('nuevo').style.display = '';
            document.getElementById('modificar').style.display = 'none';
            document.getElementById('showform').style.display = 'none';
            document.getElementById('hideform').style.display = '';
            document.getElementById('editar').style.display = 'none';
            document.getElementById('eliminar').style.display = 'none';
            document.getElementById('tabla').style.display = 'none';
            document.getElementById('id').value = "";
            document.getElementById('cedula').value = "";
            document.getElementById('nombre').value = "";
            document.getElementById('apaterno').value = "";
            document.getElementById('amaterno').value = "";
            document.getElementById('nacimiento').value = "";
            document.getElementById('sexo').value = "";
            document.getElementById('email').value = "";
            document.getElementById('tel_resid').value = "";
            document.getElementById('tel_ofi').value = "";
            document.getElementById('cel1').value = "";
            document.getElementById('cel2').value = "";
            document.getElementById('sector').value = "";
            document.getElementById('direccion').value = "";
            document.getElementById('facebook').value = "";
            document.getElementById('instagram').value = "";
        }

        function ocultarForm()
                {
                    document.getElementById('form').style.display = 'none';
                    document.getElementById('showform').style.display = '';
                    document.getElementById('hideform').style.display = 'none';
                    document.getElementById('editar').style.display = 'none';
                    document.getElementById('eliminar').style.display = 'none';
                }
        
        function editar()
        {
            document.getElementById('form').style.display = 'flex';
            document.getElementById('showform').style.display = 'none';
            document.getElementById('hideform').style.display = '';
            document.getElementById('editar').style.display = '';
            document.getElementById('eliminar').style.display = '';
            document.getElementById('nuevo').style.display = 'none';
            document.getElementById('modificar').style.display = '';
            document.getElementById('tabla').style.display = 'none';
        }         

        function validate(cedula) 
        {
            var result = validateCedula(cedula)
            document.getElementById('isValid').value = result.isValid;
            document.getElementById('inputString').value = result.inputString;
            document.getElementById('isComplete').value = result.isComplete;
            document.getElementById('separated').value = result.cedula != null ? result.cedula.toString() : "null";
        }
    </script>    
<?php
//}
require_once ("template/pie.php");
?>